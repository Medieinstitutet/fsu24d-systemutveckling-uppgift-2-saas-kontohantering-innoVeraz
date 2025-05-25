<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $customer1 = User::factory()->create([
            'name' => 'Test Customer 1',
            'email' => 'customer1@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);
        
        Newsletter::create([
            'name' => 'Test Customer 1 Newsletter',
            'description' => 'This is the first newsletter for testing purposes.',
            'user_id' => $customer1->id,
        ]);
        
        $customer2 = User::factory()->create([
            'name' => 'Test Customer 2',
            'email' => 'customer2@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);
        
        Newsletter::create([
            'name' => 'Test Customer 2 Newsletter',
            'description' => 'This is the second newsletter for testing purposes.',
            'user_id' => $customer2->id,
        ]);
        
        User::factory()->create([
            'name' => 'Test Subscriber',
            'email' => 'subscriber@example.com',
            'password' => bcrypt('password'),
            'role' => 'subscriber',
        ]);
    }
}
