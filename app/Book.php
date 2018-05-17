<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author','year','language','language_org'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
