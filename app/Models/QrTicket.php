<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrTicket extends Model
{
    protected $fillable = [
        'booking_id',
        'event_id',
        'ticket_type_id',
        'ticket_code',
        'holder_name',
        'status',
        'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'checked_in_at' => 'datetime',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }
}