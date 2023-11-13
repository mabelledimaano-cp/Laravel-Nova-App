<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studio = [
            [
                'company_name' => 'Universal Pictures',
            ],
            [
                'company_name' => 'Warner Bros',
            ],
            [
                'company_name' => 'Sony Pictures',
            ],
            [
                'company_name' => 'Walt Disney Pictures',
            ],
            [
                'company_name' => 'Paramount',
            ],
            [
                'company_name' => 'Lionsgate',
            ],
            [
                'company_name' => '20th Century Fox',
            ],
            [
                'company_name' => 'DreamWorks Studios',
            ],
        ];

        $studio = Studio::insert($studio);
    }
}
