<?php

    namespace App\Models;

    use Database\Factories\JobFactory;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Query\Builder;
    use \Illuminate\Database\Eloquent\Builder as EloquentBuilder;

    class Job extends Model
    {
        /** @use HasFactory<JobFactory> */
        use HasFactory;

        public static array $experiences= ['entry', 'middle', 'senior', 'fresher'];
        public static array $categories= ['it', 'sales', 'marketing', 'finance'];

        public function scopeFilters(EloquentBuilder|Builder $query, array $filters): Builder|EloquentBuilder {
            return $query->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            })->when($filters['min_salary'] ?? null, function ($query, $min_salary) {
                $query->where('salary', '>=', $min_salary);
            })->when($filters['max_salary']  ?? null, function ($query, $max_salary) {
                $query->where('salary', '<=', $max_salary);
            })->when($filters['experience']  ?? null, function ($query, $experience) {
                $query->where('experience', $experience);
            })->when($filters['category']  ?? null, function ($query, $category) {
                $query->where('category', $category);
            });
        }
    }
