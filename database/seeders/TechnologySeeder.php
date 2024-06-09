<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        /* $technologies= ['HTML', 'CSS','Bootstrap', 'SASS', 'Javascript', 'Vue', 'Vite', 'PHP', 'Laravel', 'MySQL','npm','git' ];

        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->color = $faker->colorName();
            $newTech->image =;
            $newTech->save();
        } */
        $json = File::get('database/json/technologies.json');
        $technologies = json_decode($json);

        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology->name;
            $newTech->slug = Str::slug($newTech->name, '-');
            $newTech->color = $technology->color;
            $newTech->image = "img/$technology->image";
            $newTech->save();
        }
    }
}
