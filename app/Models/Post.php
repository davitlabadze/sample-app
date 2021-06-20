<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $guarded = [];
    public $timestamps= true;
    public $table = 'posts';

    public function getImageUrl()
    {
        if ($this->image) {
            return $this->image;
        }

        return url('images/noimage.jpg');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
