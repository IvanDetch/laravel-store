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
            @if(!isset($category))
                {{ Form::open(['route' => ['admin.categories.store'], 'method' => 'post']) }}
            @else
                {{ Form::model($category, ['route' => ['admin.categories.update', $category->getKey()], 'method' => 'put']) }}
            @endif
            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
            </div>
            <div class="form-group">
                {{ Form::label('desc', 'Description') }}
                {{ Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
            </div>
            <div class="form-group">
                {{ Form::label('img', 'Image') }}
                {{ Form::text('img', null, ['class' => 'form-control', 'placeholder' => 'Image']) }}
            </div>
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
