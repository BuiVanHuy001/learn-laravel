@extends('layouts.app')

@section('content')
    <div class="list-group">
        @forelse($tasks as $task)
            <a href="{{ route('tasks.show', $task) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 {{ $task->completed ? 'text-decoration-line-through' : '' }}">{{ $task->name }}</h5>
                    <small>{{ $task->updated_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $task->description ?? '' }}</p>
                @if($task->notes)
                    <small class="d-inline-block text-truncate" style="max-width: 100%;">{{ $task->notes }}</small>
                @endif
            </a>
        @empty
            <li class="list-group-item">No tasks found</li>
        @endforelse
    </div>
@endsection

@if(session('message'))
    @section('scripts')
    <script type="module">
        Swal.fire({
            title: "{{ session('message') }}",
            icon: "{{ session('status') }}",
            draggable: true
        });
    </script>
    @endsection
@endif
