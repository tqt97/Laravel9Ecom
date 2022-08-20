<?php

namespace App\Models;

use App\Cast\PurifyHtml;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'cost_price',
        'price',
        'featured',
        'show_on_slider',
        'active',
        'creator_id',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'show_on_slider' => 'boolean',
        'active' => 'boolean',
        // 'description' => PurifyHtml::class,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeActive($builder)
    {
        return $builder->where('active', true);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function scopeInActive($builder)
    {
        return $builder->where('active', false);
    }
}
