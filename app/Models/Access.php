<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
        'description',
        'status',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function permission() {
        return $this->belongsTo(Permission::class);
    }
}
