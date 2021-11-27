<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'news_title',
        'image',
        'news_content',
        'seo_title',
        'seo_subtitle',
        'seo_keyword',
        'seo_description',
    ];
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
