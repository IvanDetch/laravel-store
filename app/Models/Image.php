<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['path', 'gallery_id'];

    /**
     * @return BelongsTo
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
