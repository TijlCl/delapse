<?php

namespace App\Http\Controllers;

use App\Http\Actions\GetThisWeeksCheckInsForUserAction;
use App\Http\Actions\GetUsersMonthlyCheckInDataAction;
use App\Http\DTO\CheckInDTO;
use App\Http\DTO\SettingsDTO;
use App\Http\Repositories\CheckInRepository;
use App\Http\Repositories\SettingsRepository;
use App\Http\Requests\CheckInRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\CheckInGraphResource;
use App\Http\Resources\CheckInResource;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{

    private CheckInRepository $checkInRepository;
    private GetThisWeeksCheckInsForUserAction $getThisWeeksCheckInsForUserAction;
    private GetUsersMonthlyCheckInDataAction $getUsersMonthlyCheckInDataAction;

    public function __construct(
        CheckInRepository $checkInRepository,
        GetThisWeeksCheckInsForUserAction $getThisWeeksCheckInsForUserAction,
        GetUsersMonthlyCheckInDataAction $getUsersMonthlyCheckInDataAction)
    {
        $this->checkInRepository = $checkInRepository;
        $this->getThisWeeksCheckInsForUserAction = $getThisWeeksCheckInsForUserAction;
        $this->getUsersMonthlyCheckInDataAction = $getUsersMonthlyCheckInDataAction;
    }

    /**
     * @param Request $request
     * @return CheckInGraphResource
     */
    public function index(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $chekIns = $this->getUsersMonthlyCheckInDataAction->execute(Auth::id(), $from, $to);
        return new CheckInGraphResource($chekIns);
    }

    public function weekly(Request $request)
    {
        $chekIns = $this->getThisWeeksCheckInsForUserAction->execute(Auth::id());

        return $chekIns;
    }

    /**
     * @param CheckInRequest $request
     * @return CheckInResource
     */
    public function store(CheckInRequest $request)
    {
        $checkInDTO = new CheckInDTO($request->all());
        $chekIn = $this->checkInRepository->newCheckIn(Auth::id(), $checkInDTO);

        return new CheckInResource($chekIn);
    }
}
