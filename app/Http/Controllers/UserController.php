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
        $users = $role == 'admin' ? User::orderBy('id', 'DESC')->paginate(15) : User::where('role', 'customer')->orderBy('id', 'ASC')->paginate(15);
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
        $messages = [
            'firstname.string' => 'Tên phải là chuỗi kí tự',
            'firstname.required' => 'Tên không được bỏ trống',
            'firstname.max' => 'Tên không được vượt quá 100 kí tự',
            'lastname.string' => 'Họ phải là chuỗi kí tự',
            'lastname.required' => 'Họ không được bỏ trống',
            'lastname.max' => 'Họ không được vượt quá 100 kí tự',
            'address.required' => 'Địa chỉ không được bỏ trống',
            'address.string' => 'Địa chỉ phải là chuỗi kí tự',
            'province.required' => 'Tỉnh không được bỏ trống',
            'province.string' => 'Tỉnh phải là chuỗi kí tự',
            'district.required' => 'Quận/huyện không được bỏ trống',
            'district.string' => 'Quận/huyện phải là chuỗi kí tự',
            'ward.required' => 'Phường/xã không được bỏ trống',
            'ward.string' => 'Phường/xã phải là chuỗi kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email không có sẵn',
            'telephone.required' => 'Số điện thoại không được bỏ trống',
            'telephone.string' => 'Số điện thoại phải là chuỗi kí tự',
            'telephone.min' => 'Số điện thoại không được nhỏ hơn 10 kí tự',
            'telephone.max' => 'Số điện thoại không được lớn hơn 10 kí tự',
            'password.required' => 'Mật khẩu thoại không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận không giống với mật khẩu',
            'role.required' => 'Chưa chọn vai trò',
            'role.in' => 'Vai trò không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate(
            $request,
            [
                'firstname' => 'required|string|max:100',
                'lastname' => 'required|string|max:100',
                'password' => 'required|string',
                'repassword' => 'required|string|same:password',
                'avatar' => 'nullable|string',
                'address' => 'required|string',
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
                'email' => 'required|email|unique:users',
                'telephone' => 'required|string|max:10',
                'role' => 'required|in:admin,employee,customer',
                'status' => 'required|in:active,inactive',
            ],
            $messages
        );
        $data = $request->all();

        if ($request->input('address')) {
            $this->validate($request, [
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ], $messages);

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
        $user = User::find($id);

        if ($user == null) {
            return abort(404, 'Tài khoản không tồn tại');
        }

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
        $user = User::find($id);

        if ($user == null) {
            return abort(404, 'Tài khoản không tồn tại');
        }

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
        $user = User::find($id);

        if ($user == null) {
            return abort(404, 'Tài khoản không tồn tại');
        }

        $messages = [
            'firstname.string' => 'Tên phải là chuỗi kí tự',
            'firstname.required' => 'Tên không được bỏ trống',
            'firstname.max' => 'Tên không được vượt quá 100 kí tự',
            'lastname.string' => 'Họ phải là chuỗi kí tự',
            'lastname.required' => 'Họ không được bỏ trống',
            'lastname.max' => 'Họ không được vượt quá 100 kí tự',
            'address.required' => 'Địa chỉ không được bỏ trống',
            'address.string' => 'Địa chỉ phải là chuỗi kí tự',
            'province.required' => 'Tỉnh không được bỏ trống',
            'province.string' => 'Tỉnh phải là chuỗi kí tự',
            'district.required' => 'Quận/huyện không được bỏ trống',
            'district.string' => 'Quận/huyện phải là chuỗi kí tự',
            'ward.required' => 'Phường/xã không được bỏ trống',
            'ward.string' => 'Phường/xã phải là chuỗi kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email không có sẵn',
            'telephone.required' => 'Số điện thoại không được bỏ trống',
            'telephone.string' => 'Số điện thoại phải là chuỗi kí tự',
            'telephone.min' => 'Số điện thoại không được nhỏ hơn 10 kí tự',
            'telephone.max' => 'Số điện thoại không được lớn hơn 10 kí tự',
            'password.required' => 'Mật khẩu thoại không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận không giống với mật khẩu',
            'role.required' => 'Chưa chọn vai trò',
            'role.in' => 'Vai trò không hợp lệ',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
        ];

        $this->validate($request, [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'avatar' => 'nullable|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'telephone' => 'required|string|max:10',
            'role' => 'required|in:admin,employee,customer',
            'status' => 'required|in:active,inactive',
        ], $messages);

        if ($request->input('email') != $user->email) {
            $this->validate($request, [
                'email' => 'required|email|unique:users',
            ], $messages);
        }

        $data = $request->all();

        $data['password'] = $user->password;

        if ($request->input('password')) {
            $this->validate($request, [
                'password' => 'required|string',
                'repassword' => 'required|string|same:password',
            ], $messages);
            $data['password'] = Hash::make($request->input('password'));
        }

        if ($request->input('address')) {
            $this->validate($request, [
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ], $messages);

            $address = null;
            if ($user->address) {
                $address = Address::find($user->address_id);
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
        $user = User::find($id);

        if ($user == null) {
            return abort(404, 'Tài khoản không tồn tại');
        }

        try {
            $status = $user->delete();

            if ($status) {
                request()->session()->flash('success', 'Xoá tài khoản thành công.');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ((int)$ex->errorInfo[0] === 23000) {
                request()->session()->flash('error', 'Không thể xoá vì tồn tại ràng buộc khoá ngoại!');
            } else {
                request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
            }
        }
        return redirect()->route('user.index');
    }
}
