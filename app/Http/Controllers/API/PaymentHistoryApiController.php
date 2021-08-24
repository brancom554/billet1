<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Event;


class PaymentHistoryApiController extends Controller
{
    protected $account_id;

    public function __construct()
    {
        $this->account_id = Auth::guard('api')->check() ? Auth::guard('api')->user()->account_id : null;
    }


    public function getHistory()
    {
        if($this->account_id) {

            $orders = Order::with(['event' => function ($query) {

                return $query->with(['getOneImagePerEvent' => function ($query) {

                       return $query->select('image_path', 'event_id');}]);

              }])->where('is_payment_received', '=', 1)->where('account_id', '=', $this->account_id)->get();

            $OrdersithSpecificData = $orders->map(function ($od) {

                return $od->only(['first_name', 'last_name', 'email', 'order_reference', 'order_date', 'event', 'tickets']);

            });

            return response()->json([
                'status' => 'success',
                'data' => $OrdersithSpecificData
            ],200);

        }else{

            return response()->json([
                'message' => 'Vous n\'avez pas de compte sur notre application'
            ],404);
        }
    }
}
