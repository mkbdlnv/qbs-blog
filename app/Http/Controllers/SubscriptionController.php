<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function toggleSubscription(Request $request)
    {
        $user = auth()->user();
        $subscriber = Subscriber::where('email', $user->email)->first();

        if ($subscriber) {
            $subscriber->delete();
            return response()->json(['message' => 'Вы отписались от уведомлений.']);
        } else {
            Subscriber::create(['email' => $user->email]);
            return response()->json(['message' => 'Вы подписались на уведомления.']);
        }
    }
}
