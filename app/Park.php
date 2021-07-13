<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $parkId)
 */
class Park extends Model
{
    protected $fillable = ['name', 'address', 'shedule'];
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
