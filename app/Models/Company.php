<?php

namespace App\Models;

use App\Scopes\CompanySearchScope;
use App\Scopes\ReusableSearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;

    public $fillable = ["name", "address", "email", "website", "user_id"];

    // protected $with = ['contacts'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CompanySearchScope);
    }
}
