<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecompaniesRequest;
use App\Http\Requests\UpdatecompaniesRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $companies = Company::with('tasks', 'tasks.user')
            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                }
            )
            ->get();
        return response()->json([
            CompanyResource::collection($companies),
            Response::HTTP_OK
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecompaniesRequest $request)
    {
        $company = Company::created($request->validated());
        return response()->json($company, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $companies)
    {
        $query = Company::with('tasks')->where($companies)->get();
        return response()->json($query, Response::HTTP_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecompaniesRequest $request, companies $companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(companies $companies)
    {
        //
    }
}
