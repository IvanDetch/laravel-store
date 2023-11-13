@foreach($products as $product)
    @include('catalog.card',compact('product'))
@endforeach

