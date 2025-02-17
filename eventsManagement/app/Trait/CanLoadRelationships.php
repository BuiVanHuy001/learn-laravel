<?php
namespace App\Trait;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;

trait CanLoadRelationships {
    public function loadRelationships(Model|Builder|QueryBuilder $for, ?array $relations = null): Model|Builder|QueryBuilder {
        $relations = $relations ?? $this->relations ?? [];

        foreach ($relations as $relation) {
            $for->when($this->shouldIncludeRelationships($relation), fn($q)=> $for instanceof Model ? $for->load($relation) : $q->with($relation));
        }
        return $for;
    }

    protected function shouldIncludeRelationships(string $relation): bool
    {
        $include = request()->query('include');
        if (!$include) {
            return false;
        }
        $relations = array_map('trim', explode(',', $include));
        return in_array($relation, $relations);
    }
}