<?php

namespace App\Http\Controllers;

use App\Mail\VerifyNewEmail;
use App\Mail\VerifyOldEmail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;


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

        $emailChanged = false;
        // Проверка на изменение email
        if ($request->email !== $user->email) {
            $emailChanged = true;
            $this->requestEmailChange($request->email);
        }

        // Обновление пароля, если введён
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->save();

        if ($emailChanged) {
            return response()->json(["success" => true, "message" => "Для изменения почты, вам необходимо сделать подтверждение. На вашу почту отправлено сообщение."]);
        }

        return response()->json(["success" => true, "message" => "Профиль изменен"]);

    }



    public function requestEmailChange($newEmail)
    {
        $user = auth()->user();

        // Создаем токен для подтверждения на старом email
        $token = Str::random(32);
        $user->update([
            'new_email' => $newEmail,
            'old_email_verification_token' => $token,
        ]);

        // Отправляем подтверждение на старую почту
        $verificationUrl = route('verify.old.email', ['token' => $token]);
        Mail::to($user->email)->send(new VerifyOldEmail($user, $verificationUrl));

        return response()->json(['message' => 'Подтверждение отправлено на вашу текущую почту.']);
    }

    public function confirmOldEmail($token)
    {
        $user = User::where('old_email_verification_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Неверный или устаревший токен.'], 400);
        }

        // Создаем новый токен для подтверждения на новом email

            $newToken = Str::random(32);
            $user->update([
                'old_email_verification_token' => null,
                'new_email_verification_token' => $newToken,
            ]);

            $verificationUrl = route('verify.new.email', ['token' => $newToken]);
            Mail::to($user->new_email)->send(new VerifyNewEmail($user, $verificationUrl));


        return response()->json(['message' => 'Теперь подтвердите ваш новый email.']);
    }

    public function confirmNewEmail($token)
    {
        $user = User::where('new_email_verification_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Неверный или устаревший токен.'], 400);
        }

        // Меняем email только после подтверждения
        $user->update([
            'email' => $user->new_email,
            'new_email' => null,
            'new_email_verification_token' => null
        ]);

        return response()->json(['message' => 'Email успешно обновлен!']);
    }



}
