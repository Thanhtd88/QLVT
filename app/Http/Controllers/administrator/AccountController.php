<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Account::withTrashed()->get();
        
        return view('administrator.account.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'name.required' => 'Họ tên không được để trống',
            'name.max' => 'Họ tên có độ dài tối đa tối đa :max là ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email có độ dài tối đa tối đa :max là ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu xác nhận không đúng'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('admin.account.index')->with('msg', 'Tạo tài khoản mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        User::find($id)->delete();
        return redirect()->route('admin.account.index')->with('msg', 'Xóa thành công');
    }  

    public function restore($id) {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.account.index')->with('msg', 'Khôi phục thành công');
    }

    public function forceDelete($id) {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('admin.account.index')->with('msg', 'Xóa khỏi hệ thành công');
    }
}
