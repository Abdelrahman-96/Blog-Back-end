<?php

use App\Models\Account;
use App\Models\Blog;
use App\Models\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class installSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Abdelrahman',
            'email' => 'Abdelrahman@gmail.com',
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        for ($i=0; $i < 5; $i++) { 
            Blog::insert([
                'title' => 'Foundry Training Center',
                'description' => 'Last year, we cast the vision for opening an in-person training center in the San Diego area to train bivocational church planters and act as an Ephesus-style planting hub. This generated more excitement than any of our other initiatives and we are pleased to say that our team has made progress towards opening the center.
                Multiple denominations have expressed interest or commitment to financially partnering with us to renovate a space and operate the center. We are currently working to identify the best location so that we can move forward. 
                What is even more exciting is that, once this center opens, it will become a model for hubs in other regions can operate open-handedly and interdenominationally. We are already having conversations with leaders in multiple countries about what it would look like to emulate this hub in their context.
                As we begin to break ground, would you consider financially contributing to the development of this space?',
                'user_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
