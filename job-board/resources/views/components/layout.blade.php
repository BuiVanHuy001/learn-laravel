<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - Job Board</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="mx-auto mt-10 max-w-2xl bg-gradient-to-r from-indigo-100 via-sky-100 to-emerald-500 from-10% via-30% to-80%">
<div class="mb-5 flex items-center justify-between font-semibold font-xl">
    <ul>
        <li><a href="{{ route('jobs.index') }}">Home</a></li>
    </ul>
    <ul class="flex items-center space-x-4">
        @auth
            <li class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
                <a href="{{ route('my-job-applications.index') }}">
                    {{ auth()->user()->name ?? 'Guest' }} applications
                </a>
            <li>
            <li>
                <form method="POST" action="{{ route('auth.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-semibold text-slate-900">Logout</button>
                </form>
            </li>
        @else
            <a href="{{ route('auth.create') }}">Sign in</a>
        @endauth
    </ul>
</div>
@if(session('success'))
    <div x-data="{ open: true }" x-show="open" role="alert" class="rounded-md border-l-4 border-green-500 bg-green-300 p-4 text-green-900 opacity-75 relative">
        <p class="font-bold">Success</p>
        <p>{{ session('success') ?? 'Login successfully' }}</p>
        <button class="absolute top-0 right-0 p-1.5 rounded-md focus:outline-none focus:ring-2" @click="open = false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif
{{ $slot }}
</body>
</html>
