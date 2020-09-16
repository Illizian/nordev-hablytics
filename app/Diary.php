<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;
use App\User;

class Diary extends Model
{
    protected $fillable = [
        'name',
    ];

    public function events()
    {
        return $this->belongsToMany(Tag::class)
            ->withPivot(["value"])
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }
}
