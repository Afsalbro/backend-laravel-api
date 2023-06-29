<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPreference extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'selected_source',
        'selected_categories',
        'selected_authors',
        'news_title',
        'news_description',
    ];
}
