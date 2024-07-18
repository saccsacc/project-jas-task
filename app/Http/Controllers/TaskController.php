<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $term = $request->input('term');

        $tasks = Task::with('user')
        ->when($term, function ($q, $term) {
            $q->where('title', 'LIKE', '%' . $term . '%')
                ->orWhere('status', 'LIKE', '%' . $term . '%')
                ->orWhere('due_date', 'LIKE', '%' . $term . '%');
        })
        ->orWhereHas('user', function($q) use($term) {
            $q->where('name', 'LIKE', '%' . $term . '%');
        })
        ->latest()
        ->paginate(10);

        return Inertia::render('Tasks/Index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return Inertia::render('Tasks/Create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $validatedData = $request->validated();

        try {
            Task::creates($validatedData);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with([
                    'error'=>'Failed to create task.'
                ]);
        }


        return redirect()->route('tasks.index')->with('success', 'Task has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getTask = Task::with('user')->findOrFail($id);

        return Inertia::render('Tasks/Show', compact('getTask'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $task = Task::with('user')->findOrFail($id);
        $users = User::where('id', '!=', $request->user()->id)->get();

        return Inertia::render('Tasks/Edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, string $id)
    {
        $params = $request->validated();
        $minDate = date('Y-m-d H:i:s', strtotime($params['updated_at']));
        unset($params['updated_at']);

        try {
            $result = Task::where('id', $id)->where('updated_at','<=',$minDate)->update($params);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with([
                    'error'=>'Failed to update task.'
                ]);
        }

        if($result)
            return redirect('/tasks')->with('success', 'Task has been updated!');
        else
            return redirect()
                ->back()
                ->with([
                    'error'=>'Another user has updated this data.'
                ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Task::destroy($id);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with([
                    'error'=>'Failed to delete task.'
                ]);
        }

        return back()->with('success', 'Task has been deleted!');
    }

}
