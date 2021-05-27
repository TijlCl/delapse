<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Challenge::insert([
            [
                'title' => 'Go for a walk.',
                'description' => 'Go for a walk in the park or another calming environment.',
                'image_id' => Image::where('name', 'park')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Bake a cake.',
                'description' => 'Bake your favorite cake. You can search online for recipes.',
                'image_id' => Image::where('name', 'cake')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Call a friend.',
                'description' => 'Call a friend or family just to talk.',
                'image_id' => Image::where('name', 'call')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Do a yoga exercise.',
                'description' => 'Search for a 15min yoga exercise online and follow along.',
                'image_id' => Image::where('name', 'yoga')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Take a picture of nature.',
                'description' => 'Find a beautiful spot and take a picture.',
                'image_id' => Image::where('name', 'forest')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Go jogging.',
                'description' => 'You can choose the location and duration of this exercise.',
                'image_id' => Image::where('name', 'jogging')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Cook your favorite meal.',
                'description' => "If you don't know how to make it you can search online for the recipe.",
                'image_id' => Image::where('name', 'cooking')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Cook for someone else.',
                'description' => "Prepare a meal for yourself and a friend or family member.",
                'image_id' => Image::where('name', 'cooking2')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Visit a museum.',
                'description' => "Visit any kind of museum. Maybe you can ask a friend or family member with you.",
                'image_id' => Image::where('name', 'museum')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Play a boardgame.',
                'description' => "Choose any board/card game and play it with a friend or family member. If nobody is available maybe you can visit a store where you can play boardgames.",
                'image_id' => Image::where('name', 'boardgame')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Take a relaxing bath.',
                'description' => "Take a relaxing hot bath or shower and enjoy the moment.",
                'image_id' => Image::where('name', 'bathtub')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Do a breathing exercise.',
                'description' => "Take a moment to do a breathing exercise. There are some great breathing exercises on this app at your home page.",
                'image_id' => Image::where('name', 'meditation')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Watch your favorite movie.',
                'description' => "You can watch it alone or with a friend or family member.",
                'image_id' => Image::where('name', 'tv')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => 'Watch your favorite movie.',
                'description' => "You can watch it alone or with a friend or family member.",
                'image_id' => Image::where('name', 'beach')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
        ]);
    }
}
