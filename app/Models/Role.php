<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_INSTRUCTOR = 'instructor';
    const ROLE_STUDENT = 'student';

    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
