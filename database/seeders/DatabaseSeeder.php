<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Comptes fixes
        User::create(['name'=>'Admin','email'=>'admin@cabinet.ma','password'=>Hash::make('password'),'role'=>'admin']);
        User::factory()->medecin()->create(['name'=>'Dr. Fatima Benali','email'=>'medecin@cabinet.ma']);
        User::create(['name'=>'Mohammed Alami','email'=>'patient@cabinet.ma','password'=>Hash::make('password'),'role'=>'patient']);

        // Médecins & patients aléatoires
        User::factory()->count(4)->medecin()->create();
        User::factory()->count(10)->create(); // patients

        // Services
        Service::factory()->count(5)->create();

        // 20 rendez-vous minimum
        Appointment::factory()->count(20)->create();
    }
}