<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Floor;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $floors = [
            [
                'name' => 'Ground Floor',
                'level' => 0,
                'description' => 'Main entrance, reception area, and information desk. Features study areas, computer stations, and the main circulation desk.',
                'image' => 'ground-floor-plan.jpg',
                'facilities' => ['Reception Desk', 'Study Areas', 'Computer Stations', 'Circulation Desk', 'Restrooms', 'Elevator'],
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'First Floor',
                'level' => 1,
                'description' => 'General collection books, quiet study zones, and group study rooms. Perfect for individual and collaborative learning.',
                'image' => 'first-floor-plan.jpg',
                'facilities' => ['General Collection', 'Quiet Study Zones', 'Group Study Rooms', 'Printing Station', 'Water Fountain'],
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Second Floor',
                'level' => 2,
                'description' => 'Reference materials, periodicals, and specialized collections. Includes multimedia resources and research assistance desk.',
                'image' => 'second-floor-plan.jpg',
                'facilities' => ['Reference Section', 'Periodicals', 'Multimedia Resources', 'Research Desk', 'Conference Room'],
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Third Floor',
                'level' => 3,
                'description' => 'Special collections, archives, and rare books. Features climate-controlled storage and specialized research areas.',
                'image' => 'third-floor-plan.jpg',
                'facilities' => ['Special Collections', 'Archives', 'Rare Books', 'Climate Control', 'Research Carrels'],
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Fourth Floor',
                'level' => 4,
                'description' => 'Administrative offices, staff areas, and technical services. Includes meeting rooms and staff break areas.',
                'image' => 'fourth-floor-plan.jpg',
                'facilities' => ['Admin Offices', 'Staff Areas', 'Meeting Rooms', 'Technical Services', 'Staff Lounge'],
                'is_active' => true,
                'sort_order' => 5
            ]
        ];

        foreach ($floors as $floorData) {
            Floor::create($floorData);
        }
    }
}
