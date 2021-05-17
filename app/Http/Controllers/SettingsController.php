<?php

namespace App\Http\Controllers;

use App\Http\DTO\SettingsDTO;
use App\Http\Repositories\SettingsRepository;
use App\Http\Requests\UpdateSettingsRequest;
use App\Http\Resources\SettingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @param Request $request
     * @return SettingsResource
     */
    public function index(Request $request)
    {
        $userSettings = $this->settingsRepository->findByUserId(Auth::id());

        return new SettingsResource($userSettings);
    }

    /**
     * @param UpdateSettingsRequest $request
     * @return SettingsResource
     */
    public function update(UpdateSettingsRequest $request)
    {
        $settingsDTO = new SettingsDTO($request->all());

        $userSettings = $this->settingsRepository->update(Auth::id(), $settingsDTO);

        return new SettingsResource($userSettings);
    }
}
