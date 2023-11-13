<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genre = [
            [
                'parent_id' => null,
                'name' => 'Action',
            ],
            [
                'parent_id' => null,
                'name' => 'Animation',
            ],
            [
                'parent_id' => null,
                'name' => 'Comedy',
            ],
            [
                'parent_id' => null,
                'name' => 'Drama',
            ],
            [
                'parent_id' => null,
                'name' => 'Fiction',
            ],
            [
                'parent_id' => null,
                'name' => 'Horror/Thriller',
            ],
            [
                'parent_id' => null,
                'name' => 'Romance',
            ],
            [
                'parent_id' => 1,
                'name' => 'Disaster',
            ],
            [
                'parent_id' => 1,
                'name' => 'Martial Arts',
            ],
            [
                'parent_id' => 1,
                'name' => 'Spy Film',
            ],
            [
                'parent_id' => 1,
                'name' => 'Superhero Film',
            ],
            [
                'parent_id' => 1,
                'name' => 'War',
            ],
            [
                'parent_id' => 2,
                'name' => 'CGI',
            ],
            [
                'parent_id' => 2,
                'name' => 'Live Action Animated',
            ],
            [
                'parent_id' => 2,
                'name' => 'Stop motion/Claymation',
            ],
            [
                'parent_id' => 2,
                'name' => 'Traditional Animation',
            ],
            [
                'parent_id' => 3,
                'name' => 'Action Comedy',
            ],
            [
                'parent_id' => 3,
                'name' => 'Classic Comedy',
            ],
            [
                'parent_id' => 3,
                'name' => 'Dark Comedy/Satirical',
            ],
            [
                'parent_id' => 4,
                'name' => 'Teen Drama',
            ],
            [
                'parent_id' => 4,
                'name' => 'Docu Drama',
            ],
            [
                'parent_id' => 4,
                'name' => 'Legal Drama',
            ],
            [
                'parent_id' => 4,
                'name' => 'Psychological Drama',
            ],
            [
                'parent_id' => 5,
                'name' => 'Science Fiction',
            ],
            [
                'parent_id' => 5,
                'name' => 'Teen Fiction',
            ],
            [
                'parent_id' => 5,
                'name' => 'Historical Fiction',
            ],
            [
                'parent_id' => 5,
                'name' => 'Fantasy',
            ],
            [
                'parent_id' => 5,
                'name' => 'Mystery/Detective Fiction',
            ],
            [
                'parent_id' => 6,
                'name' => 'Found Footage',
            ],
            [
                'parent_id' => 6,
                'name' => 'Psychological',
            ],
            [
                'parent_id' => 6,
                'name' => 'Slasher Film',
            ],
            [
                'parent_id' => 6,
                'name' => 'Monster/Ghost Film',
            ],
            [
                'parent_id' => 7,
                'name' => 'Romantic Comedy',
            ],
            [
                'parent_id' => 7,
                'name' => 'Romantic Tragedy',
            ],
            [
                'parent_id' => 7,
                'name' => 'Historical Romance',
            ],
        ];

        $genre = Genre::insert($genre);
    }
}
