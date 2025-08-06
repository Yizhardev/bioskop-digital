<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    private function isApiRequest(Request $request)
    {
        return $request->is('api/*') || $request->wantsJson() || $request->expectsJson();
    }


    public function login(Request $request)
    {

        if ($this->isApiRequest($request)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Use POST /api/auth/login for API authentication'
            ], 400);
        }

        return view('admin.login');
    }


    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if ($this->isApiRequest($request)) {
            return $this->handleApiLogin($request, $credentials);
        }


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            if ($user->role === 'admin' || $user->role === 'pegawai') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user' ) {
                return redirect()->route('member.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }


    private function handleApiLogin(Request $request, $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        if ($request->boolean('revoke_existing_tokens', false)) {
            $user->tokens()->delete();
        }


        $tokenName = $request->input('device_name', 'api-token');
        $expiresAt = now()->addDays(30);

        $token = $user->createToken($tokenName, ['*'], $expiresAt)->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt->toISOString()
            ]
        ], 200);
    }


    public function register(Request $request)
    {

        if ($this->isApiRequest($request)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Use POST /api/auth/register for API registration'
            ], 400);
        }

        return view('admin.register');
    }


    public function registerUp(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'nullable|in:admin,user,pegawai',
        ]);

        $user = new User();
        $user->name = $validation['name'];
        $user->email = $validation['email'];
        $user->password = Hash::make($validation['password']);


        if ($this->isApiRequest($request) && isset($validation['role'])) {
            $user->role = $validation['role'];
        } else {
            $user->role = 'user';
        }

        $user->save();


        if ($this->isApiRequest($request)) {

            $tokenName = $request->input('device_name', 'api-token');
            $expiresAt = now()->addDays(30);

            $token = $user->createToken($tokenName, ['*'], $expiresAt)->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Registration successful',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'expires_at' => $expiresAt->toISOString()
                ]
            ], 201);
        }


        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }


    public function logout(Request $request)
    {

        if ($this->isApiRequest($request)) {
            return $this->handleApiLogout($request);
        }


        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout successful');
    }


    private function handleApiLogout(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }


        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful'
        ], 200);
    }


    public function user(Request $request)
    {
        if (!$this->isApiRequest($request)) {
            return abort(404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ]
        ], 200);
    }


    public function refreshToken(Request $request)
    {
        if (!$this->isApiRequest($request)) {
            return abort(404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }


        $request->user()->currentAccessToken()->delete();


        $tokenName = $request->input('device_name', 'api-token');
        $expiresAt = now()->addDays(30);

        $token = $user->createToken($tokenName, ['*'], $expiresAt)->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully',
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expiresAt->toISOString()
            ]
        ], 200);
    }


    public function logoutAllDevices(Request $request)
    {
        if (!$this->isApiRequest($request)) {
            return abort(404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }


        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out from all devices successfully'
        ], 200);
    }


    public function activeTokens(Request $request)
    {
        if (!$this->isApiRequest($request)) {
            return abort(404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        $tokens = $user->tokens()->get(['id', 'name', 'created_at', 'last_used_at', 'expires_at']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'active_tokens' => $tokens->map(function ($token) {
                    return [
                        'id' => $token->id,
                        'name' => $token->name,
                        'created_at' => $token->created_at,
                        'last_used_at' => $token->last_used_at,
                        'expires_at' => $token->expires_at,
                        'is_current' => $token->id === request()->user()->currentAccessToken()->id
                    ];
                })
            ]
        ], 200);
    }


    public function revokeToken(Request $request, $tokenId)
    {
        if (!$this->isApiRequest($request)) {
            return abort(404);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        $token = $user->tokens()->where('id', $tokenId)->first();

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token not found'
            ], 404);
        }

        $token->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Token revoked successfully'
        ], 200);
    }
}
