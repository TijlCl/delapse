<?php

namespace App\Http\Controllers;

use App\Http\Actions\GetThisWeeksCheckInsForUserAction;
use App\Http\DTO\CheckInDTO;
use App\Http\DTO\SettingsDTO;
use App\Http\Repositories\CheckInRepository;
use App\Http\Repositories\SettingsRepository;
use App\Http\Requests\CheckInRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\CheckInResource;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{

    private CheckInRepository $checkInRepository;
    private GetThisWeeksCheckInsForUserAction $getThisWeeksCheckInsForUserAction;

    public function __construct(CheckInRepository $checkInRepository, GetThisWeeksCheckInsForUserAction $getThisWeeksCheckInsForUserAction)
    {
        $this->checkInRepository = $checkInRepository;
        $this->getThisWeeksCheckInsForUserAction = $getThisWeeksCheckInsForUserAction;
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
