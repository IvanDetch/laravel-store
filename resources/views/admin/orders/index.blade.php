@extends('admin.content')

@section('title') Orders @endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('title')</h3>

                <div class="card-tools">
                    {{ $orders->links() }}
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date and time</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
{{--                        <th>Address</th>--}}
{{--                        <th>Comment</th>--}}
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        @if(!$order->trashed())
                        <tr>
                            <td>{{ $order->getKey() }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->customerName }}</td>
                            <td>{{ $order->customerLastName }}</td>
                            <td>{{ $order->customerEmail }}</td>
                            <td>{{ $order->customerPhone }}</td>
{{--                            <td>{{ $order->customerAddress }}</td>--}}
{{--                            <td>{{ $order->comment }}</td>--}}
                            <td>{{ $order->total }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="/public/admin-panel/orders/show/{{ $order->getKey() }}" class="btn btn-warning">Show</a>
                                    <a href="/public/admin-panel/orders/delete/{{ $order->getKey() }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    @if(count($trashedOrders) > 0)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('title') | Trashed</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
{{--                            <th>Name product</th>--}}
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Comment</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashedOrders as $trashedOrder)
                            @canany(['can-orderDestroy', 'can-orderRestore'], $trashedOrder)
                                <tr>
                                    <td>{{ $trashedOrder->getKey() }}</td>
{{--                                    <td><a href="{{ route('catalog.show',['slug' => $trashedOrder->slug]) }}">{{ $trashedOrder->title }}</a></td>--}}
                                    @foreach(Cart::content() as $item)
                                        <td><div>{{ $item->name }}</div></td>
                                    @endforeach
                                    <td>{{ $trashedOrder->customerName }}</td>
                                    <td>{{ $trashedOrder->customerLastName }}</td>
                                    <td>{{ $trashedOrder->customerEmail }}</td>
                                    <td>{{ $trashedOrder->customerPhone }}</td>
                                    <td>{{ $trashedOrder->customerAddress }}</td>
                                    <td>{{ $trashedOrder->comment }}</td>
                                    <td>{{ $trashedOrder->total }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{--                                            @if(auth()->user()->is_admin)--}}
                                            <a href="{{ route('admin.orders.restore', ['order' => $trashedOrder->getKey()]) }}" class="btn btn-warning">Restore</a>
                                            <a href="{{ route('admin.orders.destroy', ['order' => $trashedOrder->getKey()]) }}" class="btn btn-danger">DROP</a>
                                            {{--                                            @endif--}}
                                        </div>
                                    </td>
                                </tr>
                            @endcanany
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    @endif
@endsection
