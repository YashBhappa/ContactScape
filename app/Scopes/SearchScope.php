<?php

namespace App\Scopes;

class SearchScope extends ReusableSearchScope
{
    protected $searchVariables = ["first_name", "last_name", "email", "phone", "company.name"];
}
