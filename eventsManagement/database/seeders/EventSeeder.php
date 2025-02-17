<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Database\Factories\EventFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        for ($i = 0; $i < 200; $i++) {
            Event::factory()->create(['user_id' => $users->random()->id]);
        }
    }
}