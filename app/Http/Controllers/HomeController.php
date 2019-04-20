<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderChange;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Order $order)
    {
        $filterData = $order::with(['partner', 'orderProducts']);
        $orders = $order->filter($filterData);

        return view('home', ['orders' => $orders]);

    }

    public function editOrder($id, Order $order)
    {
        $partners = Partner::get();

        return view("edit", ['order' => $order::find($id), 'partners' => $partners]);
    }

    /**
     * @param $id
     * @param \App\Http\Requests\OrderChange $request
     * @param \App\Models\Order $order
     */
    public function update($id, OrderChange $request, Order $model)
    {
        $order = $model::with('orderProducts')->find($id);
        $order->update([
            'client_email' => $request->post('client_email'),
            'status' => $request->post('status'),
            'partner_id' => $request->post('partner_id'),
        ]);
        $products = request('products');
        $order->orderProducts->map(function ($item) use ($products) {
            $item->update([
                'quantity' => (int) $products[$item->product_id],
            ]);
        });

        return redirect()->route("edit.order", $id);
    }

    public function products(Product $product)
    {
        $products = $product::with('vendor')
            ->when(\request('sort') == null, function ($query) {
                return $query->orderByDesc('id');
            })
            ->when(\request('sort') !== null, function ($query) {
                return \request('sort') == 'asc' ? $query->orderBy('name') : $query->orderByDesc('name');
            })
            ->paginate(15);

        return view('products', ['products' => $products]);
    }
}
