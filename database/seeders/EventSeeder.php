<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('slug', 'demo-events')->first();

        if (!$company) {
            return;
        }

        $events = [
            [
                'category' => 'Musical Shows',
                'title' => 'EventLab Music Night',
                'description' => 'A high-energy live music experience with artists, bands, lights, and premium event vibes.',
                'event_date' => now()->addDays(14)->toDateString(),
                'start_time' => '18:30',
                'end_time' => '23:00',
                'venue' => 'Nelum Pokuna Theatre',
                'city' => 'Colombo',
                'is_featured' => true,
            ],
            [
                'category' => 'Cinema Tickets',
                'title' => 'Midnight Movie Premiere',
                'description' => 'Book your movie premiere seats through WhatsApp and enjoy a smooth cinema booking experience.',
                'event_date' => now()->addDays(7)->toDateString(),
                'start_time' => '21:00',
                'end_time' => '23:30',
                'venue' => 'Liberty Cinema',
                'city' => 'Colombo',
                'is_featured' => true,
            ],
            [
                'category' => 'Stage Dramas',
                'title' => 'Laugh Night Stage Drama',
                'description' => 'A family-friendly stage drama with comedy, performance, and live theatre experience.',
                'event_date' => now()->addDays(21)->toDateString(),
                'start_time' => '19:00',
                'end_time' => '21:30',
                'venue' => 'Tower Hall Theatre',
                'city' => 'Colombo',
                'is_featured' => false,
            ],
            [
                'category' => 'Cultural Events',
                'title' => 'Kandy Cultural Viewing Stand',
                'description' => 'Reserve viewing area access for cultural event experiences through WhatsApp booking support.',
                'event_date' => now()->addDays(30)->toDateString(),
                'start_time' => '17:00',
                'end_time' => '23:00',
                'venue' => 'Kandy City',
                'city' => 'Kandy',
                'is_featured' => true,
            ],
        ];

        foreach ($events as $eventData) {
            $category = Category::where('name', $eventData['category'])->first();

            if (!$category) {
                continue;
            }

            Event::firstOrCreate(
                ['slug' => Str::slug($eventData['title'])],
                [
                    'company_id' => $company->id,
                    'category_id' => $category->id,
                    'title' => $eventData['title'],
                    'event_code' => 'EVT-' . strtoupper(Str::random(6)),
                    'description' => $eventData['description'],
                    'event_date' => $eventData['event_date'],
                    'start_time' => $eventData['start_time'],
                    'end_time' => $eventData['end_time'],
                    'venue' => $eventData['venue'],
                    'city' => $eventData['city'],
                    'status' => 'published',
                    'approval_status' => 'approved',
                    'is_featured' => $eventData['is_featured'],
                ]
            );
        }
    }
}