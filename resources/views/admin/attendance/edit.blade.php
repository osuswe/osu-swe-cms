@if(isset($_SESSION['admin']))



    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Attendance {{ $attendance->id }}</h1>

    {!! Form::model($attendance, [
        'method' => 'PATCH',
        'url' => ['/admin/attendance', $attendance->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('event_id') ? 'has-error' : ''}}">
                {!! Form::label('event_id', 'Event Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('event_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('event_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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