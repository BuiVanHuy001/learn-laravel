<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(): View|Application|Factory
    {
        $filters = request()->only(['search', 'min_salary', 'max_salary', 'experience', 'category']);
        return view('jobs.index', ['jobs' => Job::with('employer')->filters($filters)->latest()->get()]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job->load('employer')]);
    }

}
