<?php
namespace App\Http\Actions;

use App\Http\Repositories\CheckInRepository;
use App\Models\CheckIn;
use Carbon\Carbon;

class GetThisWeeksCheckInsForUserAction
{
    /**
     * @var CheckInRepository
     */
    private $checkInRepository;

    /**
     * @param CheckInRepository $checkInRepository
     */
    public function __construct(CheckInRepository $checkInRepository)
    {
        $this->checkInRepository = $checkInRepository;
    }

    /**
     * @param int $userId
     */
    public function execute(int $userId)
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $checkIns = $this->checkInRepository->getWeeklyForUser($userId, $start, $end);

        $weekly = [
            'monday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Monday';})->first(),
            'tuesday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Tuesday';})->first(),
            'wednesday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Wednesday';})->first(),
            'thursday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Thursday';})->first(),
            'friday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Friday';})->first(),
            'saturday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Saturday';})->first(),
            'sunday' => $checkIns->filter(function(CheckIn $checkIn) {return $checkIn->created_at->englishDayOfWeek === 'Sunday';})->first(),
        ];

        return $weekly;
    }
}
