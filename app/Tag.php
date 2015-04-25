<?php namespace Notes;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function notes()
    {
        return $this->belongsToMany('Notes\Note');
    }
}