@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Изменить заказ</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('update.order', $order->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Партнер</label>
                                <select name="partner_id" class="form-control">
                                    @foreach($partners as $partner)
                                        <option value="{{$partner->id}}"
                                                {{$partner->id == $order->partner_id ? 'selected' : ''}} name="partner_id">{{$partner->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="client_email">Почта клиента</label>
                                <input type="text" id="client_email" name="client_email" class="form-control"
                                       value="{{old('client_email') ?? $order->client_email}}">
                            </div>

                            <div class="form-group">
                                <label>Статус заказа</label>
                                <select name="status" class="form-control">
                                    @foreach($order::STATUS as $key => $status)
                                        <option
                                            value="{{$key}}"
                                            {{$order->status == $key ? 'selected' : ''}} name="status">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <h6 class="text-center">Продукты</h6>
                                <hr/>
                                @foreach($order->orderProducts as $key => $orderProduct)
                                    <div class="form-group">
                                        <label>{{$orderProduct->product->name}}</label>
                                        <input type="text" name="{{'products['. $orderProduct->product->id .']'}}"
                                               value="{{$orderProduct->quantity}}"
                                               class="form-control">
                                    </div>

                                @endforeach
                                <div class="float-right">
                                    Сумма: <b>{{$order->sum($order->orderProducts)}}</b>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success">Изменить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
