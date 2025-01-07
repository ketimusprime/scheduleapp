<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivitySchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'activity_date',
        'activity_time',
        'No_OP',
        'order',
        'customer_name',
        'customer_phone',
        'category_id',
        'subcategory_id',
        'products_id',
        'status',
        'users_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}

