@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create New Event</h1>
        <hr/>

        {!! Form::open(['url' => '/admin/events', 'class' => 'form-horizontal', 'id'=>'form']) !!}

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
                {!! Form::text('date', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'date']) !!}
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
                {!! Form::text('time_range', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'time_range']) !!}
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
        <input type="hidden" id="notification_send_time" name="notification_send_time" value="" required/>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::button('Create', ['class' => 'btn btn-primary form-control', 'onClick'=>'setEventDateObj()']) !!}
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
            var randCode = getRandCode();
            document.getElementById('event_code').value = "" + randCode;
            console.log(document.getElementById('event_code').value);
        };

        function setEventDateObj() {

            var eventDate = document.getElementById("date").value;
            console.log(eventDate);
            var eventTime = document.getElementById("time_range").value;
            console.log(eventTime);


            var twentyFourHours = 86400000;

            var eventDateSplit = eventDate.split("/");
            var month = eventDateSplit[0] - 1;//months start at 0 index
            var day = eventDateSplit[1];
            var year = eventDateSplit[2];

            //console.log("Time value: " + this.time);

            var timeSplit = eventTime.split("-");

            var startTime = timeSplit[0];
            var startHours = Number(startTime.match(/^(\d+)/)[1]);
            var startMinutes = Number(startTime.match(/:(\d+)/)[1]);
            var am_pm_split = startTime.split(" ");
            var AMPM = am_pm_split[1];
            console.log("Start am/pm: " + AMPM);
            if (AMPM.toLowerCase() == "pm" && startHours < 12) startHours = startHours + 12;
            if (AMPM.toLowerCase() == "am" && startHours == 12) startHours = startHours - 12;

            var eventDateObj = new Date(year, month, day, startHours, startMinutes, 0, 0);

            //set notification delivery time to 24 hours before event
            eventDateObj.setTime(eventDateObj.getTime() - twentyFourHours);
            //put date in a OneSignal acceptable format
            document.getElementById("notification_send_time").value=eventDateObj.toString();

            document.getElementById('form').submit();

        }

        /**
         * Generates 4 random digits to make code
         *
         * @returns random 4 digit number that is > 1000 &&  < 10000 && != 0
         */
        function getRandCode() {
            var randCode = Math.floor(Math.random() * 10000);

            while (randCode == 10000 || randCode == 0 || randCode < 1000) {
                randCode = Math.floor(Math.random() * 10000);
            }
            return randCode;
        }
    </script>

@endsection