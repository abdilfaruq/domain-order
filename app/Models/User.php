<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    // Override method getAuthIdentifierName
    public function getAuthIdentifierName()
    {
        return 'id';
    }
    
    protected $fillable = ['name', 'email', 'password'];

    public function configurations()
    {
        return $this->hasMany(Configuration::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
