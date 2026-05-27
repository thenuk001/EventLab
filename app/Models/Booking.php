<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'company_id',
        'event_id',
        'ticket_type_id',
        'enquiry_id',
        'booking_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'quantity',
        'unit_price',
        'total_amount',
        'status',
        'payment_status',
        'notes',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function qrTickets()
    {
        return $this->hasMany(QrTicket::class);
    }
}