<?php

namespace App\Models;

use DateTime;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function curriculum() {
        return $this->belongsTo(Curriculum::class);
    }
    
    public static function boot() {
        parent::boot();

        static::creating(function($model) {
            $now = new DateTime();
            $model->archive_code = $now->format("Ym") . str_pad(Archive::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
