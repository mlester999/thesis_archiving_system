<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;

class Archive extends Model
{
    use HasFactory, Markable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'archive_code',
        'department_id',
        'curriculum_id',
        'year',
        'title',
        'abstract',
        'members',
        'document_path',
        'document_name',
        'archive_status',
        'user_id',
    ];

    protected static $marks = [
        Bookmark::class,
    ];
}
