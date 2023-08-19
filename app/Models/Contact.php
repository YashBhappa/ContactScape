<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;
use App\Scopes\SearchScope;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ["first_name", "last_name", "phone", "email", "address", "position", "city", "country", "interest", "channel", "company_id"];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public static function booted()
    {
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new SearchScope);
    }
}
