@if(isset($_SESSION['admin']))


    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New Link</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/links', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                {!! Form::label('link', 'Link', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('link', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif