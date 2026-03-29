<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoliticianResource;
use App\Models\Politician;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PoliticianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Politician::query();
        $politicians = QueryBuilder::for($query)
            ->allowedIncludes('currentMandate', 'questions', 'questions.user', 'questions.topics')
            ->allowedFilters('first_name', 'last_name', 'currentMandate.name', AllowedFilter::callback('search', function ($query, $value) {
                $query
                    ->where('first_name', 'like', "%{$value}%")
                    ->orWhere('last_name', 'like', "%{$value}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$value}%"]);
            }))
            ->allowedSorts('first_name', 'last_name')
            ->paginate(request()->query('per_page', 10))
            ->onEachSide(1)
            ->withQueryString();
        return PoliticianResource::collection($politicians);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Politician $politician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Politician $politician)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Politician $politician)
    {
        //
    }
}
