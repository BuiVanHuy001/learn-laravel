<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Database\Factories\JobApplicationFactory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(100)->create()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create(['user_id' => $users->pop()->id]);
        }

        $employers = Employer::all();

        Job::factory()->count(150)->create(['employer_id' => function () use ($employers) {
            return $employers->random()->id;
        }]);

        User::factory()->create(['name' => 'Bui Van Huy', 'email' => 'huy@gmail.com',]);

        foreach ($users as $user) {
            $jobs = Job::inRandomOrder()->take(rand(0, 5))->get();
            foreach ($jobs as $job) {
                JobApplication::factory()->create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                ]);
            }
        }
    }
}
