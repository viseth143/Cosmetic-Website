<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    protected $table = 'product_option_value';
    protected $primaryKey = 'product_option_value_id';
    public $timestamps = false;
    protected $fillable = ['product_option_id', 'option_value', 'price_modifier', 'is_active'];
}