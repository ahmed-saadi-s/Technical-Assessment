<?php 
// database/factories/UserFactory.php
namespace Database\Factories;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '12345678', 
            'role' => UserRole::STAFF, 
        ];
    }
}
