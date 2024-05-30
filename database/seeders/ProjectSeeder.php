<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i=0; $i < 10; $i++) { 
            $project = new Project();
            $project->title = $faker->words(5, true);
            $project->slug = Str::slug($project->title, '-');
            $project->project_image = $faker->imageUrl(300, 200, 'Projects', true, $project->title, false, 'jpg');
            //$project->tools = $faker->words(5, true);
            $project->preview = $faker->url();
            $project->project_link = $faker->url();
            $project->github_link = $faker->url();
            $project->creation_date = $faker->date('Y-m-d', );
            $project->description = $faker->text(500);
            $project->save();
        }
    }
}
