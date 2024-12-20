<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'computer_name',
        'model',
        'operating_system',
        'processor',
        'memory',
        'available',
    ];

    /**
     * Define a one-to-many relationship with the Issue model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function issues()
    {
        return $this->hasMany(Issue::class, 'computer_id');
    }
}
