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
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');

                $keywords = preg_split('/\s+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY); //空白文字があるたびに区切る
                if (count($keywords) === 2) {
                $q->orWhere(function ($q2) use ($keywords) {
                    $q2->where('last_name', $keywords[0])
                    ->where('first_name', $keywords[1]);
                    });
                }
            });
        }
    }
    public function scopeDateSearch($query, $date) {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }
    public function scopeCategorySearch($query, $category_select) {
        if (!empty($category_select)) {
            $query->where('category_id', $category_select);
        }
    }
    public function scopeGenderSearch($query, $gender_select) {
        //空でない＆9（全て）が選択されていないとき
        if (!empty($gender_select) && $gender_select != 9) {
            $query->where('gender', $gender_select);
        }
    }
}
