<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'product_option';
    protected $primaryKey = 'product_option_id';
    public $timestamps = false;
    protected $fillable = ['product_id', 'option_name', 'option_type'];

    public function values()
    {
        return $this->hasMany(ProductOptionValue::class, 'product_option_id', 'product_option_id');
    }
}