<div class="admin-form-grid">
    <div class="form-card"><div class="form-card-header"><div class="form-card-icon"><i class="fas fa-list-check"></i></div><div><p class="form-card-title">Task Details</p><p class="form-card-subtitle">Title, description and due date</p></div></div><div class="form-card-body">
        <div class="field-group"><label class="field-label">Title <span class="req">*</span></label><input name="title" required class="field-input" value="{{ old('title', $task->title ?? '') }}"></div>
        <div class="field-group"><label class="field-label">Description</label><textarea name="description" rows="6" class="field-input">{{ old('description', $task->description ?? '') }}</textarea></div>
        <div class="field-group"><label class="field-label">Due Date</label><input type="date" name="due_date" class="field-input" value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"></div>
    </div></div>
    <div class="form-card"><div class="form-card-header"><div class="form-card-icon"><i class="fas fa-user-check"></i></div><div><p class="form-card-title">Assignment</p><p class="form-card-subtitle">Priority, status and assignee</p></div></div><div class="form-card-body">
        <div class="field-group"><label class="field-label">Assigned To</label><select name="assigned_to_id" class="field-input">@foreach($users as $id => $name)<option value="{{ $id }}" {{ (string) old('assigned_to_id', $task->assigned_to_id ?? '') === (string) $id ? 'selected' : '' }}>{{ $name }}</option>@endforeach</select></div>
        <div class="field-group"><label class="field-label">Priority</label><select name="priority" class="field-input">@foreach(['low','medium','high','urgent'] as $value)<option value="{{ $value }}" {{ old('priority', $task->priority ?? 'medium') === $value ? 'selected' : '' }}>{{ ucfirst($value) }}</option>@endforeach</select></div>
        <div class="field-group"><label class="field-label">Status</label><select name="status" class="field-input">@foreach(['pending'=>'Pending','in_progress'=>'In Progress','completed'=>'Completed'] as $value => $label)<option value="{{ $value }}" {{ old('status', $task->status ?? 'pending') === $value ? 'selected' : '' }}>{{ $label }}</option>@endforeach</select></div>
    </div></div>
</div>
<div class="form-actions"><button class="btn-primary" type="submit"><i class="fas fa-save"></i> Save Task</button><a href="{{ route('admin.tasks.index') }}" class="btn-ghost">Cancel</a></div>
