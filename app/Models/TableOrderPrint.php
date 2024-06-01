<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class TableOrderPrint extends Model
{
    use HasFactory;

    protected $table = 'tableorderprint';
    protected $primaryKey = 'id_orderprint';
    
    protected $fillable = [
        'id_user',
        'nama',
        'kontak',
        'material',
        'file_name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->tanggal_pesan = Carbon::now()->toDateString();
            $model->jam_pesan = Carbon::now()->toTimeString();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Accessor for file_name to get the correct URL
    public function getFileNameAttribute($value)
    {
        return Storage::url($value);
    }
}
