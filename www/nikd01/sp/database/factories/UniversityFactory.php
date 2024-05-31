<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    protected $model = University::class;

    protected static array $universities = [
        ['name' => 'Charles University', 'location' => 'Prague', 'url' => 'https://cuni.cz'],
        ['name' => 'Czech Technical University in Prague', 'location' => 'Prague', 'url' => 'https://cvut.cz'],
        ['name' => 'University of Business and Economics', 'location' => 'Prague', 'url' => 'https://vse.cz'],
        ['name' => 'Masaryk University', 'location' => 'Brno', 'url' => 'https://muni.cz'],
        ['name' => 'Brno University of Technology', 'location' => 'Brno', 'url' => 'https://vut.cz'],
        ['name' => 'Palacký University Olomouc', 'location' => 'Olomouc', 'url' => 'https://upol.cz'],
        ['name' => 'University of West Bohemia', 'location' => 'Pilsen', 'url' => 'https://zcu.cz'],
        ['name' => 'Technical University of Liberec', 'location' => 'Liberec', 'url' => 'https://tul.cz'],
        ['name' => 'University of South Bohemia', 'location' => 'České Budějovice', 'url' => 'https://jcu.cz'],
        ['name' => 'Silesian University in Opava', 'location' => 'Opava', 'url' => 'https://slu.cz'],
        ['name' => 'Mendel University in Brno', 'location' => 'Brno', 'url' => 'https://mendelu.cz'],
        ['name' => 'Harvard University', 'location' => 'Cambridge, MA', 'url' => 'https://www.harvard.edu'],
        ['name' => 'Stanford University', 'location' => 'Stanford, CA', 'url' => 'https://www.stanford.edu'],
        ['name' => 'University of California, Berkeley', 'location' => 'Berkeley, CA', 'url' => 'https://www.berkeley.edu'],
        ['name' => 'California Institute of Technology', 'location' => 'Pasadena, CA', 'url' => 'https://www.caltech.edu'],
        ['name' => 'Princeton University', 'location' => 'Princeton, NJ', 'url' => 'https://www.princeton.edu'],
        ['name' => 'University of Chicago', 'location' => 'Chicago, IL', 'url' => 'https://www.uchicago.edu'],
        ['name' => 'Columbia University', 'location' => 'New York, NY', 'url' => 'https://www.columbia.edu'],
        ['name' => 'Yale University', 'location' => 'New Haven, CT', 'url' => 'https://www.yale.edu'],
        ['name' => 'University of Oxford', 'location' => 'Oxford, England', 'url' => 'https://www.ox.ac.uk'],
        ['name' => 'University of Cambridge', 'location' => 'Cambridge, England', 'url' => 'https://www.cam.ac.uk'],
        ['name' => 'University of Pennsylvania', 'location' => 'Philadelphia, PA', 'url' => 'https://www.upenn.edu'],
        ['name' => 'Cornell University', 'location' => 'Ithaca, NY', 'url' => 'https://www.cornell.edu'],
        ['name' => 'Duke University', 'location' => 'Durham, NC', 'url' => 'https://www.duke.edu'],
        ['name' => 'Johns Hopkins University', 'location' => 'Baltimore, MD', 'url' => 'https://www.jhu.edu'],
        ['name' => 'University of Michigan', 'location' => 'Ann Arbor, MI', 'url' => 'https://www.umich.edu'],
        ['name' => 'Northwestern University', 'location' => 'Evanston, IL', 'url' => 'https://www.northwestern.edu'],
        ['name' => 'University of California, Los Angeles', 'location' => 'Los Angeles, CA', 'url' => 'https://www.ucla.edu'],
        ['name' => 'New York University', 'location' => 'New York, NY', 'url' => 'https://www.nyu.edu'],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $university = $this->faker->unique()->randomElement(self::$universities);

        return [
            'name' => $university['name'],
            'location' => $university['location'],
            'url' => $university['url'],
        ];
    }
}
