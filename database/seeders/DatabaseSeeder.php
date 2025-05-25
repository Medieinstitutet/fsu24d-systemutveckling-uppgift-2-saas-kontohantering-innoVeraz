<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Newsletter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test customer user
        $customer = User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'), // Set a known password
            'role' => 'customer',
        ]);
        
        // Create a newsletter for this customer
        Newsletter::create([
            'name' => 'Test Customer Newsletter',
            'description' => 'This is a newsletter for testing purposes.',
            'user_id' => $customer->id,
        ]);
        
        // Test subscriber user
        User::factory()->create([
            'name' => 'Test Subscriber',
            'email' => 'subscriber@example.com',
            'password' => bcrypt('password'), // Set a known password
            'role' => 'subscriber',
        ]);
    }
}
