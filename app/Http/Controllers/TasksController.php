<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoretasksRequest;
use App\Http\Requests\UpdatetasksRequest;
use App\Http\Resources\TaskResource;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $tasks = Tasks::with('user')
            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}");
                }
            )->get();

        return response()->json(
            [
                TaskResource::collection($tasks),
                Response::HTTP_CREATED
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretasksRequest $request)
    {
        $task = Tasks::create($request->validated());

        $task->load(['user', 'company']);
        $response = [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'user' => $task->user->name,
            'company' => $task->company
        ];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetasksRequest $request, tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tasks $tasks)
    {
        //
    }
}
