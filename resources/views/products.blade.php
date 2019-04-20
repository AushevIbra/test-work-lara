@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Заказы</div>

                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>ID</td>
                                <td><a href="{{route('products', ['sort' => request('sort') == 'desc' ? 'asc' : 'desc'])}}">Продукт</a></td>
                                <td>Поставщик</td>
                                <td>Цена</td>
                            </tr>
                            @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->vendor->name}}</td>
                                        <td><input type="text" class="form-control change-price" data-id="{{$product->id}}" value="{{$product->price}}"></td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$products->appends(['sort' => request('sort') == 'desc' ? 'asc' : 'desc'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
