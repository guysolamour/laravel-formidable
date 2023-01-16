<?php
namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 15; $i++) {
            Note::create([

                'online'  => $faker->randomElement([true, false]),
                'title'  => $faker->text(50),
                'description'  => $faker->realText(150),

            ]);

        }
    }
}
