<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Libraries\General;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = General::getEnumValues('users', 'role');
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'firstname' => 'string|required|max:50',
                'lastname' => 'string|required|max:50',
                'password' => 'string|required',
                'avatar' => 'nullable|string',
                'address' => 'nullable|string',
                'email' => 'string|required|unique:users',
                'telephone' => 'nullable|string|max:20',
                'role' => 'required|in:admin,employee,customer',
                'status' => 'required|in:active,inactive',
            ]
        );
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $status = User::create($data);
        if ($status) {
            request()->session()->flash('success', 'Tạo tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = General::getEnumValues('users', 'role');
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'firstname' => 'string|required|max:50',
            'lastname' => 'string|required|max:50',
            //password' => 'string|required',
            'avatar' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'string|required',
            'telephone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,employee,customer',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $status = $user->delete();
        if ($status) {
            request()->session()->flash('success', 'Xoá tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('user.index');
    }
}
