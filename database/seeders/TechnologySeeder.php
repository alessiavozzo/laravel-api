<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $technologies= ['HTML', 'CSS', 'Javascript', 'PHP', 'Vite', 'Vue', 'Laravel', 'Bootstrap'];

        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->color = $faker->colorName();
            $newTech->save();
        }
    }
}
