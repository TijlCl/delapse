<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SoberCounterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoberCounterController extends Controller
{

    private SoberCounterRepository $soberCounterRepository;

    public function __construct(SoberCounterRepository $soberCounterRepository)
    {
        $this->soberCounterRepository = $soberCounterRepository;
    }

    /**
     * @return int
     */
    public function index(): int
    {
        $soberCounter = $this->soberCounterRepository->getByUser(Auth::id());

        return $soberCounter['days_clean'];
    }

    public function getByUser(int $userId)
    {
        $soberCounter = $this->soberCounterRepository->getByUser($userId);

        return $soberCounter['days_clean'];
    }

    public function resetCounter()
    {
        $this->soberCounterRepository->setDaysClean(Auth::id(), 0);
    }
}
