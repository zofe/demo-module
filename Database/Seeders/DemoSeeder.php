<?php

namespace App\Modules\Demo\Database\Seeders;

use App\Modules\Demo\Models\Article;
use App\Modules\Demo\Models\Author;
use Faker\Factory;
use Illuminate\Database\Seeder;

/** Replaces the demo data: 10 authors with 2 articles each. */
class DemoSeeder extends Seeder
{
    public function run(): void
    {
        Article::query()->delete();
        Author::query()->delete();

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $author = Author::create([
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
            ]);

            for ($j = 1; $j <= 2; $j++) {
                Article::create([
                    'author_id' => $author->id,
                    'title' => $faker->sentence(),
                    'body' => $faker->text(),
                    'public' => true,
                    'publication_date' => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}
