<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Pages;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\PostsSeeder;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // Post::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Temp Users -- Delete This Later
        $user_generator_rules = [
            'table' => 'users',
            'length' => '10',
            'prefix' => date('ymd'),
        ];
        User::create([
            'id' => IdGenerator::generate($user_generator_rules),
            'email' => 'admin@mail.com',
            'user_type' => 1,
            'first_name' => 'Admin',
            'password' => Hash::make('admin1234'),
        ]);
        User::create([
            'id' => IdGenerator::generate($user_generator_rules),
            'email' => 'user@mail.com',
            'user_type' => 0,
            'first_name' => 'TestUserOne',
            'password' => Hash::make('user1234'),
        ]);



        // Initiate Pages -- !important
        Pages::create([
            'name' => 'Milenium Sport',
            'name_slug' => Str::slug('Milenium Sport'),
            'logo_img' => 'storage\pages_logo\milenium-logo-red.png',
        ]);
        Pages::create([
            'name' => 'Milenium Environment',
            'name_slug' => Str::slug('Milenium Environment'),
            'logo_img' => 'storage\pages_logo\milenium-logo-green.png',
        ]);
        Pages::create([
            'name' => 'Milenium History',
            'name_slug' => Str::slug('Milenium History'),
            'logo_img' => 'storage\pages_logo\milenium-logo-gold.png',
        ]);
        
    }
}
