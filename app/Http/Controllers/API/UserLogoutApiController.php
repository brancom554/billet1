<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class UserLogoutApiController extends ApiBaseController
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Log a user out
     *
     * @return mixed
     */


     /**
     * @OA\Post(
     * path="/api/logout",
     * summary="Sign out",
     * description="Sign out",
     * operationId="authSignout",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="deconnect user",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="cedric@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *          response="200",
     *          description="User created successfully.",
     *       ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request",
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

    public function doLogout()
    {
        
        $user = $this->auth->user();
        $user->token = null;
        $user->save();
        Session::flush();
        $this->auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
   
}
