<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('title')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if($errors->count() > 0)
                <p>The following errors have occurred:</p>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
            @if(!isset($product))
                {{ Form::open(['route' => ['admin.products.store'], 'method' => 'post']) }}
            @else
                {{ Form::model($product, ['route' => ['admin.products.update', $product->getKey()], 'method' => 'put']) }}
            @endif
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('price', 'Price') }}
                    {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price', 'step' => '0.11']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('barcode', 'Barcode') }}
                    {{ Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => 'Barcode']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('stock', 'On Stock Count') }}
                    {{ Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'On Stock Count']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('categories', 'Categories') }}
                    {{ Form::select('categories', $categories, null,
                                    ['class' => 'form-control', 'placeholder' => 'Select categories', 'multiple', 'name' => 'categories[]']
                    ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cover', 'Cover image') }}
                    {{ Form::text('cover', null, ['class' => 'form-control', 'placeholder' => 'Cover Image URL']) }}
                </div>
                @if(empty($product))
                    <div>
                        {{ Form::label('path', 'Gallery image') }}
                        @php
                            $keys = -1;
                        @endphp
                            @for($i = 0; $i < 4; $i++)
                            @php
                                $keys++;
                            @endphp
                            {{ Form::text('path['.$keys.']', null, ['class' => 'form-control', 'placeholder' => 'Gallery Image URL'/*, 'name' => 'path['.$i.']'*/]) }}
                            @endfor
{{--                        @foreach($images as $photo)--}}
{{--                            {{ Form::text('pathCreate', $photo->path, ['class' => 'form-control', 'placeholder' => 'Gallery Image URL']) }}--}}
{{--                        @endforeach--}}
                    </div>
                @else
                <div class="form-group">
                    {{ Form::label('path', 'Gallery image') }}
{{--                    @foreach($images as $photo)--}}
{{--                        {{ Form::text('path', $photo, ['class' => 'form-control', 'placeholder' => 'Gallery Image URL']) }}--}}
{{--                    @endforeach--}}

                    @php
                        $keys = -1;
                    @endphp
                    @foreach($images as $key=>$photo)
                        @php
                            $keys++;
                        @endphp
                        {{ Form::text('path['.$keys.']', $photo, ['class' => 'form-control', 'placeholder' => 'Gallery Image URL'/*, 'name' => 'path[]'*/]) }}
                    @endforeach

{{--                        @foreach($product->gallery->images as $photo)--}}
{{--                            {{ Form::text('path', $photo->path, ['class' => 'form-control', 'placeholder' => 'Gallery Image URL', 'name' => 'path[]']) }}--}}
{{--                        @endforeach--}}
{{--                    @php--}}
{{--                    echo $images;--}}
{{--                    @endphp--}}
                </div>
                @endif
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
