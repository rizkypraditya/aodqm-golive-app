<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table = 'revision';

    protected $fillable = [
        'admin_id',
        'report_id',
        'mitra_id',
        'status',
        'note_revision',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id')->withDefault();
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'id')->withDefault();
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id')->withDefault();
    }
}
