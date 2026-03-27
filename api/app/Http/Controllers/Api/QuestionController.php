<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params = $this->prepareQueryParams(request());
        // Get order type
        $orderBy = request()->query('order_by', 'question');
        $questions = Question::with($params['relations'])
            ->where('status', 'published')
            ->withCount($params['relations_count']);
        if ($orderBy === 'question') {
            $questions = $questions->orderBy('created_at', 'desc');
        } elseif ($orderBy === 'answers') {
            $questions = $questions->whereHas('answers');
            $questions = $questions->withAggregate('answers', 'created_at')
                ->orderBy('answers_created_at', 'DESC');
        }
        // Check if user can be authenticated and if so, add upvoted and downvoted counts
        if (auth("sanctum")->check()) {
            $questions = $questions->withExists(['upvotes as upvoted' => function ($query) {
                $query->where('user_id', auth("sanctum")->id());
            }])->withExists(['downvotes as downvoted' => function ($query) {
                $query->where('user_id', auth("sanctum")->id());
            }]);
        }
        $questions = $questions->paginate($params['per_page'], ['*'], 'page', $params['page']);
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);
        $question = Question::create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);
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
}
