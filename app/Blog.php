<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\UserScope;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
