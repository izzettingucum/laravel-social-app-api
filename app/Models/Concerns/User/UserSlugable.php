<?php

namespace App\Models\Concerns\User;

use Illuminate\Support\Str;

trait UserSlugable
{
    /**
     * @return void
     */
    public static function bootUserSlugable(): void
    {
        static::creating(function ($model) {
            $model->slug = Str::slug($model->username);
        });
    }
}
