<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Material;
use App\Models\Rating;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = University::factory()->count(20)->create();

        $universities->each(function ($university) {
            $subjects = Subject::factory()->count(10)->create([
                'university_id' => $university->id,
            ]);

            $subjects->each(function ($subject) {
                Material::factory()->count(5)->create([
                    'subject_id' => $subject->id,
                ]);
            });
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (Material $material) {
            $material->ratings()->saveMany(Rating::factory()->count(3)->make());
            $material->comments()->saveMany(Comment::factory()->count(3)->make());
        });
    }
}
