<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'contact_person',
        'email',
        'whatsapp_number',
        'status',
        'approval_status',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}