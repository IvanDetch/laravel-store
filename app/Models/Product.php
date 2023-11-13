<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, FormAccessible, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable=['title', 'slug', 'description', 'price', 'barcode', 'stock', 'cover'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasOne
     */
    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class);
    }

    public function images():BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }

}
