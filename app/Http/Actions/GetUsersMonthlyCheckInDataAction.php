<?php
namespace App\Http\Actions;

use App\Http\Repositories\CheckInRepository;
use App\Models\CheckIn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GetUsersMonthlyCheckInDataAction
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
    public function execute(int $userId, string $from, string $to)
    {
        $checkIns = $this->checkInRepository->getAll(Auth::id(), Carbon::createFromFormat('Y-m-d', $from), Carbon::createFromFormat('Y-m-d', $to));

        $groupedByMood = $checkIns->groupBy('mood');

        $moods = [
            'Happy' => isset($groupedByMood['Happy']) ? $groupedByMood['Happy']->count() : 0,
            'Loved' =>  isset($groupedByMood['Loved']) ? $groupedByMood['Loved']->count() : 0,
            'Excited' => isset($groupedByMood['Excited']) ? $groupedByMood['Excited']->count() : 0,
            'Relaxed' =>  isset($groupedByMood['Relaxed']) ? $groupedByMood['Relaxed']->count() : 0,
            'Tired' =>  isset($groupedByMood['Tired']) ? $groupedByMood['Tired']->count() : 0,
            'Bored' =>  isset($groupedByMood['Bored']) ? $groupedByMood['Bored']->count() : 0,
            'Angry' =>  isset($groupedByMood['Angry']) ? $groupedByMood['Angry']->count() : 0,
            'Stressed' =>  isset($groupedByMood['Stressed']) ? $groupedByMood['Stressed']->count() : 0,
            'Sad' =>  isset($groupedByMood['Sad']) ? $groupedByMood['Sad']->count() : 0,
        ];

        return ['total_check_ins' => $checkIns->count(), 'mood_counts' => $moods, 'check_ins' => $checkIns];
    }
}
