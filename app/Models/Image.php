<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $hidden = [
        "resource_id"
    ];

    /**
     * @return MorphTo
     */
    public function resource(): MorphTo
    {
        return $this->morphTo();
    }
}
