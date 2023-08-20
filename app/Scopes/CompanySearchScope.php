<?php

namespace App\Scopes;

use App\Scopes\ReusableSearchScope;

class CompanySearchScope extends ReusableSearchScope
{
    protected $searchVariables = ["name", "address", "email", "website"];
}
