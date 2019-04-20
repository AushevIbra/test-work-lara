<div>
    Заказ № {{$order->id}} - Завершен
</div>

<div>
    Состав заказа:
</div>

@foreach($order->orderProducts as $key => $orderProduct)
    <div class="form-group">
        <div>{{$orderProduct->product->name}} - {{$orderProduct->quantity}}</div>
    </div>

@endforeach
<div>
    Сумма: <b>{{$order->sum($order->orderProducts)}}</b>
</div>
