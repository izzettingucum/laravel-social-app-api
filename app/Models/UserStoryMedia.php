<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStoryMedia extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        "path",
        "media_type"
    ];

    /**
     * @return BelongsTo
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(UserStoryMedia::class);
    }
}
