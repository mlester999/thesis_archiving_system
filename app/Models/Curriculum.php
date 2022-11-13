<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'curr_name',
        'curr_description',
        'curr_status',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
