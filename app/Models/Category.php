<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Hapus file image dari setiap menu yang terkait
            foreach ($category->menus as $menu) {
                if ($menu->image && Storage::exists($menu->image)) {
                    Storage::delete($menu->image);
                }
            }
        });
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
