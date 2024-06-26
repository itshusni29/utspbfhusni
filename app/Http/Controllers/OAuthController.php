<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $provider = $request->header('Provider', 'google');
        $accessProviderToken = $request->header('Authorization');

        $validator = Validator::make([
            'provider' => $provider,
            'access_provider_token' => $accessProviderToken
        ], [
            'provider' => ['required', 'string'],
            'access_provider_token' => ['required', 'string']
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $validated = $this->validateProvider($provider);
        if (!is_null($validated))
            return $validated;

        $providerUser = Socialite::driver($provider)->userFromToken($accessProviderToken);
        $user = User::firstOrCreate(
            [
                'email' => $providerUser->getEmail()
            ],
            [
                'name' => $providerUser->getName(),
            ]
        );

        if (!$token = Auth::login($user)) {
            return response()->json([
                'error' => 'Gagal menghasilkan token JWT.',
                'code' => 500
            ], 500);
        }

        $response = [
            'success' => true,
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ];

        return response()->json($response, 200);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google'])) {
            return response()->json(["message" => 'You can only login via google account'], 400);
        }
    }
}
