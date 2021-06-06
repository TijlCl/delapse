<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Achievement::insert([
            [
                'title' => 'Start your delapse journey!',
                'days_required' => null,
                'image_id' => Image::where('name', 'forest2')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '10 days clean',
                'days_required' => 10,
                'image_id' => Image::where('name', 'mountains')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '20 days clean',
                'days_required' => 20,
                'image_id' => Image::where('name', 'forest2')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '50 days clean',
                'days_required' => 50,
                'image_id' => Image::where('name', 'beach')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '75 days clean',
                'days_required' => 75,
                'image_id' => Image::where('name', 'mountains2')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '100 days clean',
                'days_required' => 100,
                'image_id' => Image::where('name', 'forest')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '150 days clean',
                'days_required' => 150,
                'image_id' => Image::where('name', 'mountains4')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '200 days clean',
                'days_required' => 200,
                'image_id' => Image::where('name', 'sand')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '250 days clean',
                'days_required' => 250,
                'image_id' => Image::where('name', 'leaves')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
            [
                'title' => '300 days clean',
                'days_required' => 300,
                'image_id' => Image::where('name', 'snow')->first()->id,
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
        ]);
    }
}
