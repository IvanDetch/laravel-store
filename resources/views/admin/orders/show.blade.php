@extends('admin.content')

@section('title')
    Show orders
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>
            </div>
            <h1>Данные по заказу № {{ $order->getKey() }}</h1>

            <h3 class="mb-3">Состав заказа</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach($order->items as $item)
                    @php $i++; @endphp
                    <tr>
                        <th scope="row" style="text-align: center;">{{ $loop->iteration }}</th>
                        <td>{{ $item->product_title }}</td>
                        <td>{{ number_format($item->price, 2, '.', '') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2, '.', '') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Итого</th>
                    <th>{{ number_format($order->total, 2, '.', '') }}</th>
                </tr>
                </tfoot>
            </table>

            <h3 class="mb-3">Данные покупателя</h3>
            <p>Имя, фамилия: {{ $order->customerName }} {{ $order->customerLastName }}</p>
            <p>Адрес почты: <a href="mailto:{{ $order->customerEmail }}">{{ $order->customerEmail }}</a></p>
            <p>Номер телефона: {{ $order->customerPhone }}</p>
            <p>Адрес доставки: {{ $order->customerAddress }}</p>
            @isset ($order->comment)
                <p>Комментарий: {{ $order->comment }}</p>
            @endisset
        </div>
    </div>
@endsection
