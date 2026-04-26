<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory {
    public function definition(): array {
        $services = [
            ['name' => 'Consultation générale',  'duree' => 30, 'prix' => 150],
            ['name' => 'Consultation spécialisée','duree' => 45, 'prix' => 300],
            ['name' => 'Bilan de santé',          'duree' => 60, 'prix' => 500],
            ['name' => 'Radiologie',              'duree' => 20, 'prix' => 200],
            ['name' => 'Analyse sanguine',        'duree' => 15, 'prix' => 100],
        ];
        $s = fake()->randomElement($services);
        return [
            'name'          => $s['name'],
            'description'   => fake()->sentence(),
            'duree_minutes' => $s['duree'],
            'prix'          => $s['prix'],
        ];
    }
}