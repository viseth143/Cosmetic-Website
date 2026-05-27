<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categoies';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = ['category_name', 'description', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}