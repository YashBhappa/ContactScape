<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\FilterScope;
use App\Scopes\SearchScope;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ["first_name", "last_name", "phone", "email", "address", "position", "city", "country", "interest", "channel"];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public static function userCompanies()
    {
        return Company::where('user_id', auth()->user()->id)->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }
}
