@extends('layouts.app')

@section('title')
    Cart
@endsection

@section('content')
    <div class="container wow fadeIn">
        <h2 class="my-5 text-center">Your cart</h2>

        @if(Cart::count() > 0)
            <table class="table table-striped">
                <thead class="black white-text">
                <tr>
                    <th scope="col" style="text-align: center;">#</th>
                    <th scope="col" style="text-align: center;">Product</th>
                    <th scope="col" style="padding-left: 75px;">Quantity</th>
                    <th scope="col" style="text-align: center;">Price</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @php $i = 0; @endphp
                @foreach(Cart::content() as $key => $item)
                    @php $i++; @endphp
                    <tr>
                        <th scope="row" style="text-align: center;">{{ $i }}</th>
                        <td style="text-align: center;">{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST">
                                {!! method_field('PATCH') !!}
                                {!! csrf_field() !!}
                                <input type="hidden" name="productId" value="{{ $item->rowId }}">
                                <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </form>
                        </td>
                        <td align="center">${{ $item->price * $item->qty }}</td>
                        <td align="center">
                            <a href="{{ route('cart.drop', ['productId' => $item->rowId]) }}" type="button"
                               class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td colspan="2" align="right"><strong>${{ Cart::total() }}</strong></td>
                </tr>
                </tfoot>
            </table>
            <a href="{{ route('cart.destroy') }}" class="btn-danger btn btn-lg">Clear cart</a>
            <a href="{{ route('cart.checkout') }}" class="btn-success btn btn-lg">
                Checkout <i class="fa fa-arrow-right"></i>
            </a>
        @else
            <blockquote class="blockquote bg-warning">
                <p class="bq-title">Do you like our products?</p>
                <p>Your cart is empty now. You can choose product in our <a href="{{ url('catalog') }}">catalog</a> and
                    enjoy them!
                </p>
            </blockquote>
        @endif
    </div>
@stop
