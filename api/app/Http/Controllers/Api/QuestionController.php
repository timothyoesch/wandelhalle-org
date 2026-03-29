<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class QuestionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Question::query()->withAggregate('answers', 'created_at');
        $questions = QueryBuilder::for($query)
            ->allowedIncludes('answers', 'topics', 'politician', 'politician.currentMandate', 'user')
            ->allowedFilters('body', 'user.name', 'politician.id', 'topics.name')
            ->allowedSorts('created_at', 'answers_created_at')
            ->withCount(['upvotes', 'downvotes']);

        //if sort query string contains answers_created_at, only return questions that have at least one answer
        if (str_contains(request()->query('sort', ''), 'answers_created_at')) {
            $questions = $questions->has('answers');
        }
        // Check if user can be authenticated and if so, add upvoted and downvoted counts
        if (auth("sanctum")->check()) {
            $questions = $questions->withExists(['upvotes as upvoted' => function ($query) {
                $query->where('user_id', auth("sanctum")->id());
            }])->withExists(['downvotes as downvoted' => function ($query) {
                $query->where('user_id', auth("sanctum")->id());
            }]);
        }
        $questions = $questions
            ->paginate(request()->query('per_page', 10))
            ->onEachSide(1)
            ->withQueryString();
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string',
            'politician_id' => 'nullable|exists:politicians,id',
            'rationale' => 'nullable|string',
            'topic_ids' => 'nullable|array',
            'topic_ids.*' => 'exists:topics,id',
        ]);
        $question = new Question($validated);
        $question->user_id = $request->user()->id;
        $question->save();
        if (isset($validated['topic_ids'])) {
            $question->topics()->sync($validated['topic_ids']);
        }
        return response()->json($question, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        if ($question->status !== 'published') {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }
        $question->load(['user', 'answers']);
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);
        $validated = $request->validate([
            'body' => 'required|string',
            'politician_id' => 'nullable|exists:politicians,id',
            'rationale' => 'nullable|string',
        ]);
        $question->update($validated);
        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        return response()->json([
            'message' => 'Question deleted successfully',
        ], 204);
    }

    protected function prepareQueryParams(Request $request)
    {
        $per_page = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        $relations = $request->query('relations', 'answers,topics,politician,politician.currentMandate,user');
        $relations_count = $request->query('relations_count', 'upvotes,downvotes');

        return [
            'per_page' => $per_page,
            'page' => $page,
            'relations' => explode(',', $relations),
            'relations_count' => explode(',', $relations_count),
        ];
    }

    public function vote(Request $request, Question $question)
    {
        $validated = $request->validate([
            'type' => 'nullable|in:like,dislike',
        ]);
        $user = $request->user();
        if ($validated['type'] === null) {
            Vote::where('user_id', $user->id)
                ->where('question_id', $question->id)
                ->delete();
            return response()->json([
                'message' => 'Vote removed successfully',
            ]);
        }
        $is_upvote = $validated['type'] === 'like';
        Vote::updateOrCreate(
            [
                'user_id' => $user->id,
                'question_id' => $question->id,
            ],
            [
                'is_upvote' => $is_upvote,
            ]
        );
        return response()->json([
            'message' => 'Vote recorded successfully',
        ]);
    }
}
