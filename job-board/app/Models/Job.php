<?php

    namespace App\Models;

    use Database\Factories\JobFactory;
    use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Database\Query\Builder;

    class Job extends Model
    {
        /** @use HasFactory<JobFactory> */
        use HasFactory, SoftDeletes;
        protected $fillable = ['title', 'description', 'location', 'salary', 'experience', 'category'];
        public static array $experiences= ['entry', 'middle', 'senior', 'fresher'];
        public static array $categories= ['it', 'sales', 'marketing', 'finance'];

        public function employer(): BelongsTo
        {
            return $this->belongsTo(Employer::class);
        }

        public function jobApplications(): hasMany
        {
            return $this->hasMany(JobApplication::class);
        }

        public function scopeFilters(EloquentBuilder|Builder $query, array $filters): Builder|EloquentBuilder {
            return $query->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('employer', function ($query) use ($search) {;
                            $query->where('company_name', 'like', '%' . $search . '%');
                        });
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

        public function isAppliedBy(User $user)
        {
            return $this->where('id', $this->id)->whereHas('jobApplications', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->exists();
        }
    }
