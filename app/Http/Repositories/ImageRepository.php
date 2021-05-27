<?php

namespace App\Http\Repositories;

use App\Models\Image;

class ImageRepository extends BaseRepository
{

    /**
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }


    public function getRandom()
    {
        return Image::where('event_image', true)->inRandomOrder()->first();
    }
}
