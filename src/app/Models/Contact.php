<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected $fillable = [
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];

    public function scopeKeywordSearch($query, $keyword) {
        if (!empty($keyword)) {
            $query->where('first_name', 'like', '%' . $keyword . '%')
            ->orWhere('last_name', 'like', '%' . $keyword . '%');
        }
    }
}
