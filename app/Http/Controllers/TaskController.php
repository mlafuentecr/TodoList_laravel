<?php

namespace App\Http\Controllers;

use App\Models\Task; // Add the missing import statement for the Task model
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task['tasks'] = Task::all();
        return view('task.index', $task);
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
    public function store(Request $request)
    {
        $task = request()->all();
        Task::create($task);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage. $request->isChecked
     */
    public function update( Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->update(['is_done' => $request->isChecked ? 0 : 1])) {
            return response()->json(['success' => 'Task updated successfully.']);
        } else {
            return response()->json(['error' => 'Failed to update task.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect('/');
    }
}
