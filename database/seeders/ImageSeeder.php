<?php

namespace Database\Seeders;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $imageList = array(
            array(
                'name' => 'add-event-bg',
                'event_image' => true,
            ),
            array(
                'name' => 'barber',
                'event_image' => false,
            ),
            array(
                'name' => 'bathtub',
                'event_image' => false,
            ),
            array(
                'name' => 'beach',
                'event_image' => true,
            ),
            array(
                'name' => 'boardgame',
                'event_image' => false,
            ),
            array(
                'name' => 'breathing',
                'event_image' => true,
            ),
            array(
                'name' => 'cake',
                'event_image' => false,
            ),
            array(
                'name' => 'call',
                'event_image' => false,
            ),
            array(
                'name' => 'cleaning',
                'event_image' => false,
            ),
            array(
                'name' => 'coast',
                'event_image' => true,
            ),
            array(
                'name' => 'cooking',
                'event_image' => false,
            ),
            array(
                'name' => 'cooking2',
                'event_image' => false,
            ),
            array(
                'name' => 'cooking3',
                'event_image' => false,
            ),
            array(
                'name' => 'forest',
                'event_image' => true,
            ),
            array(
                'name' => 'forest2',
                'event_image' => true,
            ),
            array(
                'name' => 'home-header-bg',
                'event_image' => true,
            ),
            array(
                'name' => 'icecream',
                'event_image' => false,
            ),
            array(
                'name' => 'jogging',
                'event_image' => false,
            ),
            array(
                'name' => 'leaves',
                'event_image' => true,
            ),
            array(
                'name' => 'login-bg',
                'event_image' => true,
            ),
            array(
                'name' => 'meditation',
                'event_image' => false,
            ),
            array(
                'name' => 'mountains',
                'event_image' => true,
            ),
            array(
                'name' => 'mountains2',
                'event_image' => true,
            ),
            array(
                'name' => 'mountains3',
                'event_image' => true,
            ),
            array(
                'name' => 'mountains4',
                'event_image' => true,
            ),
            array(
                'name' => 'museum',
                'event_image' => false,
            ),
            array(
                'name' => 'park',
                'event_image' => true,
            ),
            array(
                'name' => 'register-bg',
                'event_image' => true,
            ),
            array(
                'name' => 'report-bg',
                'event_image' => true,
            ),
            array(
                'name' => 'sand',
                'event_image' => true,
            ),
            array(
                'name' => 'sky',
                'event_image' => true,
            ),
            array(
                'name' => 'snow',
                'event_image' => true,
            ),
            array(
                'name' => 'tv',
                'event_image' => false,
            ),
            array(
                'name' => 'tv2',
                'event_image' => false,
            ),
            array(
                'name' => 'yoga',
                'event_image' => false,
            ),
        );

        // add timestamps
        foreach ($imageList as $index => $image) {
            $imageList[$index]['created_at'] = Carbon::now();
            $imageList[$index]['updated_at'] = Carbon::now();
        }


        Image::insert($imageList);
    }
}
