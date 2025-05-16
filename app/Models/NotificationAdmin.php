<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{

    protected $appends = [
        //
    ];

    public $fillable = [
        'view_by',
        'view_at',
        'user_id',
        'title',
        'subtitle',
        'meta_data_id',
        'is_read',
        'is_received',
        'type'
    ];


    public function VuePar()  {
        return $this->belongsTo(User::class, 'view_by');
    }
}
