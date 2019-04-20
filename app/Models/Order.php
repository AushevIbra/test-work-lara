<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    public const STATUS = [0 => 'Новый', 10 => 'Подтвержден', 20 => 'Завершен'];
    protected $guarded = [];

    /**
     * Функция получает все продукты моделя
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function sum(Collection $products)
    {
        $sum = 0;
        foreach ($products as $product) {
            $sum += $product->price * $product->quantity;
        }

        return $sum;
    }

    /**
     * Сортировка данных
     *
     * @param $orders
     * @return mixed
     */
    public function filter($orders)
    {

        if (\request('date') == '-1') {
            return $orders->where([['delivery_dt', '<', DB::raw('curdate()')], ['status', 10]])->take(50)->get();
        }

        if (\request('date') == 'current') {
            return $orders->where([
                ['delivery_dt', '>=', DB::raw('curdate()')],
                ['delivery_dt', '<=', DB::raw('curdate() + interval 1 day')],
                ['status', 10],
            ])->paginate(15);
        }

        if (\request('date') == 'new') {
            return $orders->where([
                ['delivery_dt', '>', DB::raw('curdate() + interval 1 day')],
                ['status', 0],
            ])->paginate(15);
        }

        if (\request('status') == 'success') {
            return $orders->where([
                ['delivery_dt', '>=', DB::raw('curdate()')],
                ['delivery_dt', '<=', DB::raw('curdate() + interval 1 day')],
                ['status', 20],
            ])->orderByDesc('delivery_dt')->take(50)->get();
        }

        else {
            return $orders->orderBy('id', 'desc')->paginate(15);
        }
    }
}
