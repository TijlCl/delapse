<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
