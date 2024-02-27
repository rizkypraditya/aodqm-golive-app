<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $fillable = [
        'mitra_id',
        'description',
        'location',
        'project_title',
        'file_report',
        'file_report_2',
        'file_report_3',
        'file_report_4',
        'status',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id')->withDefault();
    }

    public function revision()
    {
        return $this->hasOne(Revision::class, 'report_id', 'id')->withDefault();
    }
}
