<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Domain\Users\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private function guard(): JWTGuard
    {
        /** @var JWTGuard */
        return auth('api'); 
    }
    public function login(Request $request)
    {
        $creds = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! $token = $this->guard()->attempt($creds)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->tokenResponse($token);
    }

    public function refresh()
    {
        $new = $this->guard()->refresh();      
        return $this->tokenResponse($new);
    }

    public function logout()
    {
        $this->guard()->logout();              
        return response()->json(['message' => 'Logged out']);
    }
    public function signup(Request $request)
    {


        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);


        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Log::info('Signup successful', [
            'user_id' => $user->id,
            'email'   => $user->email,
        ]);

        return response()->json(['message' => 'User created'], 201);
    }



    private function tokenResponse(string $token)
    {
        return response()->json([
            'token_type'   => 'Bearer',
            'access_token' => $token,
            'expires_in'   => $this->guard()->factory()->getTTL() * 60, // seconds
        ]);
    }
}
