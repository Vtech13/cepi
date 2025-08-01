<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class PusherController extends Controller
{
    public function authenticate(Request $request)
    {
        try {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'encrypted' => true
                ]
            );

            $channelName = $request->channel_name;
            $socketId = $request->socket_id;

            if (Auth::check()) {
                $response = $pusher->socket_auth($channelName, $socketId);
                return response($response);
            } else {
                return response('Unauthorized', 403);
            }
        } catch (\Exception $e) {
            error_log($e); // Log the exception
            return response('Server Error', 500);
        }
    }
}