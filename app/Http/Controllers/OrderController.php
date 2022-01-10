<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(15);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if ($order == null) {
            return abort(404, 'Đơn đặt hàng không tồn tại');
        }

        return view('admin.order.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        if ($order == null) {
            return abort(404, 'Đơn đặt hàng không tồn tại');
        }

        return view('admin.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order == null) {
            return abort(404, 'Đơn đặt hàng không tồn tại');
        }

        $messages = [
            'status.required' => 'Chưa chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'note' => 'Ghi chú phải là chuỗi kí tự'
        ];

        $this->validate($request, [
            'status' => 'required|in:new,accepted,delivering,cancel,done',
            'note' => 'nullable|string',
        ], $messages);

        $data = $request->all();

        if ($request->status == 'accepted') {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->quantity -= $item->quantity;
                $product->save();
            }
        }

        if (($order->status == 'accepted' || $order->status == 'delivering') && $request->status == 'cancel') {
            foreach ($order->items as $item) {
                $product = $item->product;
                $product->quantity += $item->quantity;
                $product->save();
            }
        }

        $status = $order->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật đơn hàng thành công');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('order.index');
    }
}
