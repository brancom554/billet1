<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;  
use Exception;
use App\Models\User;
use Carbon\Carbon;



class UserLoginApiController extends ApiBaseController
{
    protected $captchaService;

    public function __construct()
    {
        $captchaConfig = config('attendize.captcha');
        if ($captchaConfig["captcha_is_on"]) {
            $this->captchaService = Factory::create($captchaConfig);
        }

        $this->middleware('api');

    }

    /**
     * Handles the login request.
     *
     * @param  Request  $request
     *
     * @return mixed
     */

    /**
     * @OA\Post(
     * path="/api/auth/login",
     * summary="Sign in",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="cedric@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *          response="200",
     *          description="User created successfully."
     *       ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */


    public function postLogin(Request $request, User $user)
    {

        $credentials = request(['email', 'password']);

        $validator = Validator::make($credentials, [
                'email' => 'required',
                'password' => 'required|string|min:6',
            ]);


            if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if($token = JWTAuth::attempt($credentials)){
            try{

                $user = auth()->guard('api')->user();
                $user->update([
                'token' => $token
            ]);
                $date = Carbon::now()->format('Y-m-d H:i:s');

            return $this->respondWithToken($token,$date);
            
            }
            catch (Exception $e){
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                   
                    return response()->json([
                        'data' => null,
                        'status' => false,
                        'message' => 'Token Expired'
                    ],200
                    );
                }
            }

        } 
        // return redirect()->intended(route('showSelectOrganiser'));
     }

     protected function respondWithToken($token,$date)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'connected_at' => $date
        ],200);
    }
}
