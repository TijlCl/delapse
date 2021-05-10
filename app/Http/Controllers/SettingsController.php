<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SettingsRepository;
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

    public function index(Request $request)
    {
        $userSettings = $this->settingsRepository->findByUserId(Auth::id());

        return new SettingsResource($userSettings);
    }
}
