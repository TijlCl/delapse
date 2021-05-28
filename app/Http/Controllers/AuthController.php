<?php

namespace App\Http\Controllers;

use App\Http\Actions\RegisterUserAction;
use App\Http\DTO\RegisterUserDTO;
use App\Http\DTO\SettingsDTO;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * @var RegisterUserAction
     */
    private RegisterUserAction $registerUserAction;

    /**
     * AuthController constructor.
     * @param RegisterUserAction $registerUserAction
     */
    public function __construct(RegisterUserAction $registerUserAction)
    {
        $this->registerUserAction = $registerUserAction;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) :JsonResponse
    {
        $this->registerUserAction->execute(new RegisterUserDTO($request->all()), new SettingsDTO($request->all()), $request['days_clean']);
        return response()->json([
            'message' => 'User registered successfully'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request) :JsonResponse
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function user() :JsonResponse
    {
        $user = auth()->user();
        if ($user['image']) {
            $user['image'] = Storage::disk('public')->url($user['image']);
        }

        return response()->json(compact('user'));
    }
}
