@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create New Event</h1>
        <hr/>

        {!! Form::open(['url' => '/admin/events', 'class' => 'form-horizontal']) !!}

        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
            {!! Form::label('location', 'Location', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('time_range') ? 'has-error' : ''}}">
            {!! Form::label('time_range', 'Time Range', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('time_range', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('time_range', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('time_range') ? 'has-error' : ''}}">
            {!! Form::label('event_code', 'Event Code', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('event_code', null, ['class' => 'form-control','id'=>'event_code','required' => 'required',]) !!}
                {!! $errors->first('event_code', '<p class="help-block">:message</p>') !!}
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
    <script>
        window.onload = function () {
            var randCode=getRandCode();
            document.getElementById('event_code').value = "" + randCode;
            console.log(document.getElementById('event_code').value);
        };


        function scheduleNotification(){

            console.log("in scheduling process...");

            var notificationObj={
                "app_id": "a263afad-afe2-471e-b0da-a9d0467b9cb3",
                "included_segments": ["All"],
                "contents": {"en": "English Message"},
            };

            var headers={
                "Content-Type": "application/json; charset=utf-8",
                "Authorization": "Basic N2I1NDVmNjAtZDBkMS00N2ExLTkwY2YtODczMTQ4ZmZlYTJm"
            };

            $.ajax({
                url: "https://onesignal.com/api/v1/notifications",
                data: notificationObj,
                dataType: "json",
                headers: headers,
                success:function(data){
                    console.log("Notification scheduled");
                },
                error:function(err){
                    console.log(err);
                }

            });
        }

        /**
         * Generates 4 random digits to make code
         *
         * @returns random 4 digit number that is > 1000 &&  < 10000 && != 0
         */
        function getRandCode() {
            var randCode = Math.floor(Math.random() * 10000);

            while(randCode == 10000 || randCode == 0 || randCode < 1000){
                randCode=Math.floor(Math.random() * 10000);
            }
            return randCode;
        }
    </script>

@endsection