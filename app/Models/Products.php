<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_category_id',
        'name'
    ];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
