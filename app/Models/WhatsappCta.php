<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappCta extends Model
{
    protected $fillable = [
        'event_id',
        'booking_number',
        'support_number',
        'cta_label',
        'template_message',
        'qr_code_path',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}