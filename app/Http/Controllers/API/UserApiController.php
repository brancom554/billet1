<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\Passcheck;
use Hash;
use Validator;


class UserApiController extends ApiBaseController
{
    /**
     * edit user 
     *
     */


      /**
     * @OA\Get(
     *      path="api/user",
     *      operationId="getUserData",
     *      tags={"User"},
     *      summary="Get data",
     *      description="Returns User info",
     *      security={ {"bearer": {}} },
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
    public function showEditUser()
    {
        $data = [
            'user' => auth()->user(),
        ];

        if($data){
            return response()->json([
                'success'   =>  true,
                'data' => $data
            ], 200);

        }else{

            return response()->json([
                'success'   =>  false,
                'message' => 'Cet Utilisateur n\'existe pas'
            ], 404);
        }

        
    }

    /**
     * Updates the current user
     *
     * @param Request $request
     * @return mixed
     */


    /**
     * @OA\Post(
     * path="/api/user",
     * summary="Edit user",
     * description="Update user info",
     * operationId="User",
     * tags={"User"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Update user",
     *    @OA\JsonContent(
     *       required={"email","password", "first_name", "last_name", "new_password", "new_password_confirmation"},
     *       @OA\Property(property="email", type="string", format="email", example="cedric@gmail.com"),
     *       @OA\Property(property="first_name", type="string", format="first_name", example="user1"),
     *       @OA\Property(property="last_name", type="string", format="last_name", example="user2"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="new_password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="new_password_confirmation",  type="string", format="password", example="Try20pass"),
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
    public function postEditUser(Request $request)
    {
        $rules = [
            'email'        => [
                'required',
                'email',
                'unique:users,email,' . Auth::user()->id . ',id,account_id,' . Auth::user()->account_id
            ],
            'password'     => [new Passcheck],
            'new_password' => ['min:8', 'confirmed', 'required_with:password'],
            'first_name'   => ['required'],
            'last_name'    => ['required'],
        ];

        $messages = [
            'email.email'         => trans("Controllers.error.email.email"),
            'email.required'      => trans("Controllers.error.email.required"),
            'password.passcheck'  => trans("Controllers.error.password.passcheck"),
            'email.unique'        => trans("Controllers.error.email.unique"),
            'first_name.required' => trans("Controllers.error.first_name.required"),
            'last_name.required'  => trans("Controllers.error.last_name.required"),
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status'   => 'error',
                'messages' => $validation->messages()->toArray(),
            ]);
        }

        $user = Auth::user();

        if ($request->get('password')) {
            $user->password = Hash::make($request->get('new_password'));
        }

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        $user->save();

        return response()->json([
            'status'  => 'success',
            'message' => trans("Controllers.successfully_saved_details"),
        ],200);
    }
}
