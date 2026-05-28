<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'slug',
        'event_code',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'venue',
        'city',
        'map_url',
        'poster',
        'banner',
        'status',
        'approval_status',
        'approval_comment',
        'approved_by',
        'approved_at',
        'rejected_at',
        'is_featured',
        'views_count',
        'whatsapp_clicks_count',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    // Relationships
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }

    public function whatsappCta()
    {
        return $this->hasOne(WhatsappCta::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function qrTickets()
    {
        return $this->hasMany(QrTicket::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}