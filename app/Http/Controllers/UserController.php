<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Address;
use App\Libraries\General;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        $users = $role == 'admin' ? User::orderBy('id', 'DESC')->paginate(10) : User::where('role', 'customer')->orderBy('id', 'ASC')->paginate(10);
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
                'repassword' => 'string|required|same:password',
                'avatar' => 'nullable|string',
                'address' => 'nullable|string',
                'province' => 'nullable|string',
                'district' => 'nullable|string',
                'ward' => 'nullable|string',
                'email' => 'string|required|unique:users',
                'telephone' => 'nullable|string|max:20',
                'role' => 'required|in:admin,employee,customer',
                'status' => 'required|in:active,inactive',
            ]
        );
        $data = $request->all();

        if ($request->input('address')) {
            $this->validate($request, [
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ]);

            $address = new Address();
            $address->address = $data['address'];
            $address->province_id = $data['province'];
            $address->district_id = $data['district'];
            $address->ward_id = $data['ward'];
            $address->save();
            $data['address_id'] = $address->id;
        }

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
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
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
            'avatar' => 'nullable|string',
            'address' => 'nullable|string',
            'province' => 'nullable|string',
            'district' => 'nullable|string',
            'ward' => 'nullable|string',
            'email' => 'string|required',
            'telephone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,employee,customer',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->all();

        if ($request->input('password')) {
            $this->validate($request, [
                'password' => 'string|required',
                'repassword' => 'string|required|same:password',
            ]);
        }

        if ($request->input('address')) {
            $this->validate($request, [
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ]);

            $address = null;
            if ($user->address) {
                $address = Address::findOrFail($user->address_id);
            } else {
                $address = new Address();
            }
            $address->address = $data['address'];
            $address->address = $data['address'];
            $address->province_id = $data['province'];
            $address->district_id = $data['district'];
            $address->ward_id = $data['ward'];
            $address->save();
            $data['address_id'] = $address->id;
        }

        $data['password'] = Hash::make($request->password);

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
