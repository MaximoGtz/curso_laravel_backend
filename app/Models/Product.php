<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "stock",
        "price",
        "category_id",
        "description"
    ];
    protected $hidden = [
        "created_at",
        "updated_at"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
