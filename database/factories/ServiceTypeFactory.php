<?php 
namespace Database\Factories;

use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceTypeFactory extends Factory
{
    protected $model = ServiceType::class;

    protected $serviceNames = [
        'Car Wash',
        'Oil Change',
        'Tire Replacement',
        'Battery Check',
        'Brake Inspection',
        'Engine Tune-Up',
        'AC Service',
        'Wheel Alignment',
        'Interior Cleaning',
        'Exterior Polishing',
    ];

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement($this->serviceNames),
            
            'description' => $this->faker->sentence(6, true),
        ];
    }
}
