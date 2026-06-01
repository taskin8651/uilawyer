<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::with(['creator', 'assignee'])->latest()->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::orderBy('name')->pluck('name', 'id')->prepend('Unassigned', '');

        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validateTask($request);
        $data['created_by_id'] = auth()->id();

        Task::create($data);

        return redirect()->route('admin.tasks.index')->with('message', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load(['creator', 'assignee']);

        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::orderBy('name')->pluck('name', 'id')->prepend('Unassigned', '');

        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->update($this->validateTask($request));

        return redirect()->route('admin.tasks.index')->with('message', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back()->with('message', 'Task deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Task::whereIn('id', (array) $request->input('ids', []))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateTask(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);
    }
}
