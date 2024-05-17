<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['name'];

    public function configurations()
    {
        return $this->hasMany(Configuration::class);
    }
}
