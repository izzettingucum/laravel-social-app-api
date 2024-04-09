<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Story extends Model
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function storyMedia(): HasOne
    {
        return $this->hasOne(UserStoryMedia::class);
    }
}
