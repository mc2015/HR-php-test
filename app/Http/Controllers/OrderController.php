<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Partner;
use App\OrderProduct;
use Session;

class OrderController extends Controller
{
    public function index()
    {
		$orders = Order::all();

		$orderStatuses = config('enums.orderStatuses');

		return view('orders.index', compact('orders', 'orderStatuses'));
    }

    public function edit($id)
    {
        $order = Order::find($id);

        $partners = Partner::all();

        $orderProductListArray = OrderProduct::getOrderProductListArray($id);

        $orderStatuses = config('enums.orderStatuses');

        return view('orders.edit', compact('order', 'partners', 'orderProductListArray', 'orderStatuses'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $this->validate($request, [
            'client_email' => 'required',
            'partner_id' => 'required'
        ]);

        $input = $request->all();

        $order->client_email = $input['client_email'];
        $order->partner_id = $input['partner_id'];
        $order->status = $input['order_status'];

        $order->save();

        Session::flash('flash_message', 'Заказ сохранен');

        return redirect()->route('orders.index');

    }
}
