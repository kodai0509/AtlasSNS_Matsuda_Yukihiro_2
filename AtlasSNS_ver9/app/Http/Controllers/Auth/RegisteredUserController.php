<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // バリデーション処理
        $request->validate([
            'username' => 'required|string|min:2|max:12',
            'email' => ['required', 'string', 'email', 'min:5', 'max:40', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:20', 'regex:/^[a-zA-Z0-9]+$/'],
            'password_confirmation' => ['required', 'string', 'min:8', 'max:20', 'same:password', 'regex:/^[a-zA-Z0-9]+$/'],
        ], [
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.min' => 'メールアドレスは5文字以上で入力してください。',
            'email.max' => 'メールアドレスは40文字以内で入力してください。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'password.regex' => 'パスワードは英数字のみ使用可能です。',
            'password_confirmation.required' => 'パスワード確認は必須です。',
            'password_confirmation.same' => 'パスワード確認が一致しません。',
        ]);

        // ユーザー作成
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session(['username' => $user->username]);
        return redirect()->route('added');
    }


    public function added(): View
    {
        $username = session('username');
        return view('auth.added', compact('username'));
    }

    public function index(): View
    {
        return view('posts.index');
    }
}
