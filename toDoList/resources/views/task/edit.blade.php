@extends('layouts.app')

@section('content')
    <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ $task->notes }}</textarea>
        </div>
        <div class="d-flex justify-content-start align-items-center" style="gap: 10px;">
            <button type="submit" class="btn btn-primary d-flex align-items-center"><i class="bi bi-pencil-fill"></i> Update</button>
    </form>

    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger d-flex align-items-center"><i class="bi bi-trash"></i> Delete</button>
    </form>

    <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary d-flex align-items-center">
        <i class="bi bi-arrow-90deg-left"></i> Back
    </a>
    </div>
@endsection
