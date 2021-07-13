<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(string $park)
 */
class Car extends Model
{
    protected $fillable = ['user_id'. 'park_id', 'driver', 'number'];
}
