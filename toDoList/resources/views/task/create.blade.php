@extends('layouts.app')

@section('content')
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name" name="name" value="{{ old('name') }}">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control {{ $errors->has('description') ? 'border-danger' : '' }}" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-90deg-left"></i> Back</a>
    </form>
@endsection

