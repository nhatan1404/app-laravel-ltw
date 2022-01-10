<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('id', 'DESC')->paginate('15');
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.create');
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
            'code.required' => 'Code không được bỏ trống',
            'code.string' => 'Code phải là chuỗi kí tự',
            'code.max' => 'Code không được lớn hơn 20 kí tự',
            'type.required' => 'Chưa chọn loại',
            'type.in' => 'Loại không hợp lệ',
            'value.required' => 'Giá trị không được bỏ trống',
            'value.numeric' => 'Giá trị phải là số',
            'value.min' => 'Giá trị phải lớn hơn hoặc bằng 1',
            'value.max' => 'Giá trị không được lớn hơn 100',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'time.required' => 'Số lượt sử dụng không được bỏ trống',
            'time.numeric' => 'Số lượt sử dụng phải là số',
        ];

        $this->validate($request, [
            'code' => 'required|string|max:20',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'time' => 'required|numeric',
        ], $messages);

        $type = strtolower($request->input('type'));

        if ($type == 'percent') {
            $this->validate($request, [
                'value' => 'required|numeric|min:1|max:100',
            ]);
        }

        $data = $request->all();
        $status = Voucher::create($data);

        if ($status) {
            request()->session()->flash('success', 'Tạo mã giảm giá thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('voucher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);

        if ($voucher == null) {
            request()->session()->flash('error', 'Mã giảm giá không tồn tại');
            return redirect()->route('voucher.index');
        }

        return view('admin.voucher.detail', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voucher = Voucher::find($id);

        if ($voucher == null) {
            request()->session()->flash('error', 'Mã giảm giá không tồn tại');
            return redirect()->route('voucher.index');
        }

        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $voucher = Voucher::find($id);

        if ($voucher == null) {
            request()->session()->flash('error', 'Mã giảm giá không tồn tại');
            return redirect()->route('voucher.index');
        }

        $messages = [
            'code.required' => 'Code không được bỏ trống',
            'code.string' => 'Code phải là chuỗi kí tự',
            'code.max' => 'Code không được lớn hơn 20 kí tự',
            'type.required' => 'Chưa chọn loại',
            'type.in' => 'Loại không hợp lệ',
            'value.required' => 'Giá trị không được bỏ trống',
            'value.numeric' => 'Giá trị phải là số',
            'value.min' => 'Giá trị phải lớn hơn hoặc bằng 1',
            'value.max' => 'Giá trị không được lớn hơn 100',
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'time.required' => 'Số lượt sử dụng không được bỏ trống',
            'time.numeric' => 'Số lượt sử dụng phải là số',
        ];

        $this->validate($request, [
            'code' => 'required|string|max:20',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|in:active,inactive',
            'time' => 'required|numeric',
        ], $messages);

        $type = strtolower($request->input('type'));

        if ($type == 'percent') {
            $this->validate($request, [
                'value' => 'required|numeric|min:1|max:100',
            ]);
        }


        $data = $request->all();
        $status = $voucher->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật mã giảm giá thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id);

        if ($voucher == null) {
            request()->session()->flash('error', 'Mã giảm giá không tồn tại');
            return redirect()->route('voucher.index');
        }

        $status = $voucher->delete();

        if ($status) {
            request()->session()->flash('success', 'Đã xoá mã giảm giá thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('voucher.index');
    }
}
