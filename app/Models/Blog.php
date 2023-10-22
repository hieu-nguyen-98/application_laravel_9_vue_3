<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'meta_title',
        'title',
        'content',
        'image',
        'image_title',
        'description',
        'date',
        'view'
    ];

    protected $appends = ['formatted_date'];
    protected $casts = [
        'date' => 'datetime',
    ];

    public function formattedDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->date->format('Y-m-d h:i A'),
        );
    }
}
