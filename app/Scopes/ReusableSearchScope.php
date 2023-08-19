<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Summary of FilterScope
 */
class ReusableSearchScope implements Scope
{
    /**
     * Summary of apply
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    protected $searchVariables = [];
    // protected $searchVariables = ["first_name", "last_name", "email", "phone", "company.name"];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) {
            $firstIteration = true; // Flag to track the first iteration

            foreach ($this->searchVariables as $column) {
                $arr = explode(".", $column);

                if (count($arr) === 2) {
                    list($col, $col2) = $arr;

                    if ($firstIteration) {
                        $builder->whereHas($col, function ($query) use ($search, $col2) {
                            $query->where($col2, 'LIKE', "%$search%");
                        });
                        $firstIteration = false;
                    } else {
                        $builder->orWhereHas($col, function ($query) use ($search, $col2) {
                            $query->where($col2, 'LIKE', "%$search%");
                        });
                    }
                } else {
                    if ($firstIteration) {
                        $builder->where($column, 'LIKE', "%$search%");
                        $firstIteration = false;
                    } else {
                        $builder->orWhere($column, 'LIKE', "%$search%");
                    }
                }
            }

            //without reusable scope
            // $builder->where('first_name', 'LIKE', "%$search%");
            // $builder->orWhere('last_name', 'LIKE', "%$search%");
            // $builder->orWhere('email', 'LIKE', "%$search%");
            // $builder->orWhere('phone', 'LIKE', "%$search%");
            // $builder->orWhereHas('company', function ($query) use ($search) {
            //     $query->where('name', 'LIKE', "%$search%");
            // });
        }
    }
}
