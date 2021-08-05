<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Attendize\Utils;
use App\Models\Account;
use App\Models\User;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use Mail;
use Services\Captcha\Factory;
use Illuminate\Support\Facades\Validator;


class UserSignupApiController extends ApiBaseController
{
    protected $user; 

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function __construct(Guard $auth)
    {
        if (Account::count() > 0 && !Utils::isAttendize()) {

            return response()->json([
                'success'   =>  false,
                'message'      =>  'Action non authorisé'
            ], 401);
        }

        $this->auth = $auth;

        $captchaConfig = config('attendize.captcha');
        if ($captchaConfig["captcha_is_on"]) {
            $this->captchaService = Factory::create($captchaConfig);
        }

        $this->middleware('guest');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */

    public function showSignup()
    {
        $is_attendize = Utils::isAttendize();

        return response()->json([
            'message' => 'returned successfully',
            'attendize' => $is_attendize
        ], 201);

    }


    /**
     * Creates an account.
     *
     * @param Request $request
     *
     */

    /**
     * @OA\Post(
     * path="/api/auth/signup",
     * summary="Sign up",
     * description="Sign up",
     * operationId="authSignup",
     * tags={"User"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create user",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="cedric@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="first_name", type="string", format="first_name", example="user1"),
     *       @OA\Property(property="last_name", type="string", format="last_name", example="user2"),
     *       @OA\Property(property="password_confirmation",  type="string", format="password", example="Try20pass"),
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

    public function postSignup(Request $request)
    {
   
        $is_attendize = Utils::isAttendizeCloud();

        $input = $request->all();

        $validator = Validator::make($input, [
            'email'        => 'required|email|unique:users',
            'password'     => 'required|min:8|confirmed',
            'first_name'   => 'required',
            'last_name'   => 'required',
            'terms_agreed' => $is_attendize ? 'required' : ''
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        
        // if (is_object($this->captchaService)) {
        //     if (!$this->captchaService->isHuman($request)) {
            
        //         return response()->json([
        //             'message' => 'Unauthorised',
        //         ], 401);
        //     }
        // }

        $account_data = $request->only(['email', 'first_name', 'last_name']);
        $account_data['currency_id'] = config('attendize.default_currency');
        $account_data['timezone_id'] = config('attendize.default_timezone');
        $account = Account::create($account_data);

        $user = new User();
        $user_data = $request->only(['email', 'first_name', 'last_name']);
        $user_data['password'] = Hash::make($request->get('password'));
        $user_data['account_id'] = $account->id;
        $user_data['is_parent'] = 1;
        $user_data['is_registered'] = 1;
        $user = User::create($user_data);

        if ($is_attendize) {
            // TODO: Do this async?
            Mail::send('Emails.ConfirmEmail',
                ['first_name' => $user->first_name, 'confirmation_code' => $user->confirmation_code],
                function ($message) use ($request) {
                    $message->to($request->get('email'), $request->get('first_name'))
                        ->subject(trans("Email.attendize_register"));
                });
        }

        return response()->json([
            'message' => 'User successfully registered'
        ], 201);


    }


    /**
     * @OA\Get(
     *      path="api/signup/confirm_email/{confirmation_code}",
     *      operationId="getConfirmationCode",
     *      tags={"User"},
     *      summary="Get code",
     *      description="Returns code",
     * 
     *      @OA\Parameter(
     *          name="confirmation_code",
     *          description="",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function confirmEmail($confirmation_code)
    {
        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Mail is not confirmed',
            ], 400);
        }

        $user->is_confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return response()->json([
            'message' => 'Mail is registered, you can logged now',
        ], 201);
    }

}
