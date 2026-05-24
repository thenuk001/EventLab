<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cinema Tickets',
                'icon' => '🎬',
                'color' => 'purple',
                'description' => 'Movie tickets, cinema showtimes, and theatre bookings.',
            ],
            [
                'name' => 'Musical Shows',
                'icon' => '🎤',
                'color' => 'orange',
                'description' => 'Concerts, live music events, and artist shows.',
            ],
            [
                'name' => 'Stage Dramas',
                'icon' => '🎭',
                'color' => 'blue',
                'description' => 'Drama, theatre, cast performances, and stage shows.',
            ],
            [
                'name' => 'Cultural Events',
                'icon' => '🪔',
                'color' => 'green',
                'description' => 'Perahera, festivals, and cultural experiences.',
            ],
            [
                'name' => 'Corporate Events',
                'icon' => '💼',
                'color' => 'slate',
                'description' => 'Conferences, seminars, workshops, and business events.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'icon' => $category['icon'],
                    'color' => $category['color'],
                    'description' => $category['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}