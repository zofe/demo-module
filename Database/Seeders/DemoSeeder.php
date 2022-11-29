<?php

namespace App\Modules\Demo\Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1;$i <= 10;$i++) {
            DB::table('demo_authors')->insert(
                [
                    'firstname' => $faker->firstName,
                    'lastname' => $faker->lastName,
                ]
            );
            for ($j = 1;$j <= 2;$j++) {
                DB::table('demo_articles')->insert(
                    [
                        'author_id' => $i,
                        'title' => $faker->sentence,
                        'body' => $faker->text,
                        'public' => 1,
                        'publication_date' => $faker->dateTime,
                    ]
                );
            }
        }
    }
}
