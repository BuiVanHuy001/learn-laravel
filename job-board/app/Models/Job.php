<?php

    namespace App\Models;

    use Database\Factories\JobFactory;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Job extends Model
    {
        /** @use HasFactory<JobFactory> */
        use HasFactory;

        public static array $experiences= ['entry', 'middle', 'senior', 'fresher'];
        public static array $categories= ['it', 'sales', 'marketing', 'finance'];
    }
