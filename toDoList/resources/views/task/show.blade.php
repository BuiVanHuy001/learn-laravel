@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title {{ $task->completed ? 'text-decoration-line-through' : '' }}">{{ $task->name }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">{{ $task->description }}</h6>
            @if($task->notes)
                <small class="card-text">{{ $task->notes }}</small>
            @endif
            <p class="card-text mt-3">
                <small class="text-muted">Created {{ $task->created_at->diffForHumans() }} | Updated {{ $task->updated_at->diffForHumans() }}</small>
            </p>
            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-{{ $task->completed ? 'danger' : 'success' }}">Mark as {{ $task->completed ? 'uncompleted' : 'completed' }}</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i> Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-90deg-left"></i> Back</a>
        </div>
    </div>
@endsection
