<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Summary of FilterScope
 */
class FilterScope implements Scope
{
    /**
     * Summary of apply
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($companyId = request()->query('company_id')) {
            $builder->where('company_id', $companyId);
        }
    }
}
