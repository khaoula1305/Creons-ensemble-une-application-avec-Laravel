<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = auth()->id();
            $model->ip = request()->ip();
        });
    }

    public function commentable() {
         return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
