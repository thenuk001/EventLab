<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'event_id',
        'company_id',
        'ticket_type_id',
        'customer_name',
        'customer_phone',
        'quantity',
        'cta_type',
        'status',
        'source_page',
        'clicked_at',
    ];

    protected function casts(): array
    {
        return [
            'clicked_at' => 'datetime',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}