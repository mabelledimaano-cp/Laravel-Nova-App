<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $director = [
            [
                'name' => 'Martin Scorsese',
            ],
            [
                'name' => 'Tim Burton',
            ],
            [
                'name' => 'Christopher Nolan',
            ],
            [
                'name' => 'Quentin Tarantino',
            ],
            [
                'name' => 'Guillermo del Toro',
            ],
            [
                'name' => 'Wes Anderson',
            ],
            [
                'name' => 'David Fincher',
            ],
            [
                'name' => 'Francis Ford Coppola',
            ],
            [
                'name' => 'Russo Brothers',
            ],
            [
                'name' => 'James Gunn',
            ],
            [
                'name' => 'Greta Gerwig',
            ],
            [
                'name' => 'Charlotte Wells',
            ],
        ];

        $director = Director::insert($director);
    }
}
