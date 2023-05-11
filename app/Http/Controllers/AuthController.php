<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/register",
 *     tags={"UserAuth"},
 *     summary="Register API's",
 *     @OA\RequestBody(
 *          description= "- Register to your account",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="name", type="string"),
 *              @OA\Property(property="email", type="email"),
 *              @OA\Property(property="password", type="password"),
 *              @OA\Property(property="password_confirmation", type="password")
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Succesfully Login",
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Succesfully Login",
 *      ),
 *      @OA\Response(
 *         response=419,
 *         description="Unauthorhized",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */

    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    
        /**
 * Get a JWT via given credentials.
 *
 * @OA\Post(
 *     path="/login",
 *     tags={"UserAuth"},
 *     summary="Login API's",
 *     @OA\RequestBody(
 *          description= "- Login to add products",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              required={"email","password"},
 *              @OA\Property(property="email", type="email"),
 *              @OA\Property(property="password", type="password"),
 *          )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Succesfully Login",
 *      ),
 *     @OA\Response(
 *         response=201,
 *         description="Succesfully Login",
 *      ),
 *      @OA\Response(
 *         response=419,
 *         description="Unauthorhized",
 *      ),
 *    )
 *
 * @return \Illuminate\Http\JsonResponse
 */

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check Email
        $user = User::where('email', $fields['email'])->first();
       
        // Check Password 
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Laksamana'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Laksamana'
        ];

    }
}
