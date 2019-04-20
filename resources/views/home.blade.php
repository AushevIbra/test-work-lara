@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Заказы</div>

                    <div class="card-body">
                        <div class="row m-2">
                            <div class="col-2">
                                <a href="{{route('home')}}" class="btn btn-outline-primary w-100">Все</a>
                            </div>
                            <div class="col-3">
                                <a href="{{route('home', ['date' => '-1'])}}" class="btn btn-outline-primary w-100">Просроченные</a>
                            </div>
                            <div class="col-2">
                                <a href="{{route('home', ['date' => 'current'])}}" class="btn btn-outline-primary w-100">Текущие</a>
                            </div>
                            <div class="col-2">
                                <a href="{{route('home', ['date' => 'new'])}}" class="btn btn-outline-primary w-100">Новые</a>
                            </div>

                            <div class="col-3">
                                <a href="{{route('home', ['status' => 'success'])}}" class="btn btn-outline-primary w-100">Выполненные</a>
                            </div>

                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>
                                    ID
                                </th>

                                <th>
                                    Название партнера
                                </th>

                                <th>
                                    Стоимость заказа
                                </th>

                                <th>
                                    Состав заказа
                                </th>

                                <th>
                                    Дата заказа
                                </th>

                                <th>
                                    Статус заказа
                                </th>

                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{route('edit.order', $order->id)}}">
                                            {{$order->id}}
                                        </a>
                                    </td>

                                    <td>
                                        {{$order->partner->name}}
                                    </td>

                                    <td>
                                        {{$order->sum($order->orderProducts)}}
                                    </td>

                                    <td>
                                        @foreach($order->orderProducts as $product)
                                            {{$product->product->name  . ' '}}
                                        @endforeach

                                    </td>

                                    <td>
                                        {{$order->delivery_dt}}
                                    </td>

                                    <td>
                                        {{$order::STATUS[$order->status]}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{(request('date') !== '-1') && request('status') !== 'success' ? $orders->appends(['date' => request('date'), 'status' => request('success')])->links() : null}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
