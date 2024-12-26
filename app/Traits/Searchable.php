<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable {
    /**
     * @throws Exception
     */
    public function scopeSearch(Builder $builder, $term = null): Builder
    {
        if (!$this->searchable)
        {
            throw new Exception("Searchable array not define in your model.");
        }

        foreach ($this->searchable as $searchable)
        {
            if (str_contains($searchable, '.'))
            {
                $relation = Str::beforeLast($searchable, '.');
                $column = Str::afterLast($searchable, '.');
                $builder->orWhereRelation($relation, $column, 'LIKE', "%$term%");
                continue;
            }

            $builder->orWhere($searchable, 'LIKE', "%$term%");
        }

        return $builder;
    }
}
