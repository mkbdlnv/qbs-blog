<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('blog.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        // Проверка на изменение email
        if ($request->email !== $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null; // Сбрасываем верификацию
            $user->save();

            // Повторная отправка подтверждения
            event(new Registered($user));
        }

        // Обновление пароля, если введён
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', true);
    }

}
