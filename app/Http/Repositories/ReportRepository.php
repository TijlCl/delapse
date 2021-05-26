<?php

namespace App\Http\Repositories;

use App\Http\DTO\ReportDTO;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReportRepository extends BaseRepository
{

    /**
     * @param Report $model
     */
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function createReport(ReportDTO $DTO): Report
    {
        $report = new Report([
            'reason' => $DTO->reason,
            'description' => $DTO->description
        ]);

        $report->user()->associate($DTO->userId);
        $report->reporter()->associate(Auth::id());

        $report->save();
        return $report;
    }
}
