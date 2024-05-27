<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    protected static array $subjects = [
        ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'The study of numbers, shapes, and patterns.'],
        ['name' => 'Science', 'code' => 'SCI', 'description' => 'The study of the natural world.'],
        ['name' => 'History', 'code' => 'HIST', 'description' => 'The study of past events.'],
        ['name' => 'English', 'code' => 'ENG', 'description' => 'The study of the English language and literature.'],
        ['name' => 'Art', 'code' => 'ART', 'description' => 'The study of visual and performing arts.'],
        ['name' => 'Music', 'code' => 'MUS', 'description' => 'The study of musical theory and performance.'],
        ['name' => 'Physical Education', 'code' => 'PE', 'description' => 'The study of physical fitness and sports.'],
        ['name' => 'Computer Science', 'code' => 'CS', 'description' => 'The study of computer systems and programming.'],
        ['name' => 'Foreign Language', 'code' => 'FL', 'description' => 'The study of languages other than the native language.'],
        ['name' => 'Health', 'code' => 'HEALTH', 'description' => 'The study of health and wellness.'],
        ['name' => 'Social Studies', 'code' => 'SOC', 'description' => 'The study of society and social relationships.'],
        ['name' => 'Business', 'code' => 'BUS', 'description' => 'The study of commerce and trade.'],
        ['name' => 'Home Economics', 'code' => 'HOME EC', 'description' => 'The study of household management.'],
        ['name' => 'Industrial Arts', 'code' => 'IND ARTS', 'description' => 'The study of technical and mechanical subjects.'],
        ['name' => 'Agriculture', 'code' => 'AG', 'description' => 'The study of farming and cultivation.'],
        ['name' => 'Technology', 'code' => 'TECH', 'description' => 'The study of technological advancements.'],
        ['name' => 'Engineering', 'code' => 'ENG', 'description' => 'The study of engineering principles and applications.'],
        ['name' => 'Family and Consumer Science', 'code' => 'FCS', 'description' => 'The study of family dynamics and consumer behavior.'],
        ['name' => 'Driver Education', 'code' => 'DRIVER ED', 'description' => 'The study of driving skills and road safety.'],
        ['name' => 'Other', 'code' => 'OTHER', 'description' => 'Miscellaneous subjects.'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subject = $this->faker->randomElement(self::$subjects);

        return [
            'university_id' => University::factory(),
            'name' => $subject['name'],
            'code' => $subject['code'],
            'description' => $subject['description'],
        ];
    }
}
