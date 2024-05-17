<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'domain', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
