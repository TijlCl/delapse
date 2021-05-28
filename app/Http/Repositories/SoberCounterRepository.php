<?php

namespace App\Http\Repositories;

use App\Models\SoberCounter;

class SoberCounterRepository extends BaseRepository
{

    /**
     * @param SoberCounter $model
     */
    public function __construct(SoberCounter $model)
    {
        parent::__construct($model);
    }

    public function getByDaysClean(int $daysClean, array $with = [])
    {
        return SoberCounter::with($with)->where('days_clean', $daysClean)->get();
    }
}
