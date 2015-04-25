<?php namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    protected $fillable = ['message'];

    public function user()
    {
        return $this->belongsTo('Notes\User');
    }

    public function tags()
    {
        return $this->belongsToMany('Notes\Tag');
    }

}