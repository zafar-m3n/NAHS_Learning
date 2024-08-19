<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = ['user_id'];

    /**
     * Get the user that owns the lecturer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that the lecturer teaches.
     */
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
