<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;

class RemindersApiController extends ApiBaseController
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The password broker implementation.
     *
     * @var PasswordBroker
     */
    protected $passwords;

    public function __construct(Guard $auth, PasswordBroker $passwords)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;

        $this->middleware('guest');
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     */
    protected function getEmailSubject()
    {
      return isset($this->subject) ? 
        
        response()->json([
            'success'   =>  true,
            'data' => $this->subject,
        ], 200)  :
        
        response()->json([
            'success'   =>  false,
            'data' => $this->subject,
            'message' => trans("Controllers.your_password_reset_link")
        ], 404);
        
    }

    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    // public function getRemind()
    // {
    //     return \View::make('Public.LoginAndRegister.ForgotPassword');
    // }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind(Request $request)
    {
        $this->validate($request, ['email' => 'required']);

        $response = $this->passwords->sendResetLink($request->only('email'));

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:

                return response()->json([
                    'status', trans($response),
                    'success'   =>  false,
                    'massage' => 'Request succesfully',
                ], 200);

                return redirect()->back()->with();

            case PasswordBroker::INVALID_USER:
                return response()->json([
                    'success'   =>  false,
                    'massage' => 'Invalid User',
                    'email' => trans($response)
                ], 404);

        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param string $token
     *
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            \App::abort(404);
        }

        return response()->json([
            'success'   =>  true,
            'token' => $token
        ], 200);

    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);

            $user->save();

            $this->auth->login($user);
        });

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:
                return response()->json([
                    'success'   =>  false,
                    'message' => trans("Controllers.password_successfully_reset")
                ], 200);

            default:

            return response()->json([
                'success'   =>  true,
                'email' => trans($response),
                'error' => $request->only('email')
            ], 200);

        }
    }
}
