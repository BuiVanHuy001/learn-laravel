<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): Application|Factory|View
    {
        $tasks = Task::all();
        return view('task.index', ['tasks' => $tasks, 'title' => 'Task List']);
    }

    public function show(Task $task): Application|Factory|View
    {
        return view('task.show', ['task' => $task, 'title' => 'Task Details']);
    }

    public function edit(Task $task): View|Factory|Application
    {
        return view('task.edit', ['task' => $task, 'title' => 'Edit Task']);
    }

    public function create(): View|Factory|Application
    {
        return view('task.create', ['title' => 'Create Task']);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validateInput($request);
        try {
             Task::create([
                'name' => $request->name,
                'description' => $request->description,
                'notes' => $request->notes,
            ]);

            return redirect()->route('tasks.index')->with([
                'message' => 'Task created successfully.',
                'status' => 'success'
            ]);
        }catch (\Exception $e) {
            return redirect()->route('tasks.index')->with([
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->validateInput($request);
        try {
            $task->update($request->only(['name', 'description', 'notes']));
            return redirect()->route('tasks.index')->with([
                'message' => 'Task updated successfully.',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with([
                'message' => 'Failed to update task.',
                'status' => 'error'
            ]);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('tasks.index')->with([
                'message' => 'Task deleted successfully.',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.index')->with([
                'message' => 'Failed to delete task.',
                'status' => 'error'
            ]);
        }
    }

    public function toggleComplete(Request $request, Task $task): RedirectResponse
    {
        $task->toggleComplete();
        return redirect()->back();
    }
    private function validateInput(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tasks,name',
            'description' => 'nullable|string',
        ]);
    }
}
