<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'is_featured',
        'views_count',
        'whatsapp_clicks_count',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}