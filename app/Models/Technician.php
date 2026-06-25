<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    //

    protected $table = 'technicians';

    protected $fillable = [
        'user_id',
        'phone',
        'specialty',
        'location',
        'experience_years',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
