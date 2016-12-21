@if(isset($_SESSION['admin']))



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
                {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'date']) !!}
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

        <div class="form-group {{ $errors->has('event_code') ? 'has-error' : ''}}">
            {!! Form::label('event_code', 'Event Code', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('event_code', null, ['class' => 'form-control','id'=>'event_code','required' => 'required',]) !!}
                {!! $errors->first('event_code', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('start_time', 'Start Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::time('start_time', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'start_time']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('end_time', 'End Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::time('end_time', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'end_time']) !!}
            </div>
        </div>

        <input type="hidden" id="time_range" name="time_range" required />
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
            // var eventTime = document.getElementById("time_range").value;
            // console.log(eventTime);

            var twentyFourHours = 86400000;

            //format of date is yyyy-mm-dd
            var eventDateSplit = eventDate.split("-");
            var year = eventDateSplit[0];
            var month = eventDateSplit[1] - 1;//months start at 0 index
            var day = eventDateSplit[2];


            //console.log("Time value: " + this.time);

            var startTime = document.getElementById('start_time').value;
            var endTime = document.getElementById('end_time').value;

            console.log(startTime);
            var startHours = Number(startTime.match(/^(\d+)/)[1]);
            var startMinutes = Number(startTime.match(/:(\d+)/)[1]);

            var endHours = Number(endTime.match(/^(\d+)/)[1]);
            var endMinutes = Number(endTime.match(/:(\d+)/)[1]);

            // console.log(startHours);
            // console.log(startMinutes);
            var startAMPM="";
            var endAMPM="";

            //figure out am/pm for start time
            if(startHours >= 12){
              startAMPM="pm";
            }
            else{
              startAMPM = "am";
            }

            //figure out am/pm for end time
            if(endHours >= 12){
              endAMPM="pm";
            }
            else{
              endAMPM = "am";
            }

            var eventDateObj = new Date(year, month, day, startHours, startMinutes, 0, 0);

            //set notification delivery time to 24 hours before event
            eventDateObj.setTime(eventDateObj.getTime() - twentyFourHours);

            //put date in a OneSignal acceptable format
            document.getElementById("notification_send_time").value=eventDateObj.toString();

            console.log("Start am/pm: " + startAMPM);

            //reformat time_range to be displayable
            if (startAMPM.toLowerCase() == "pm" && startHours >= 12) startHours = startHours - 12;
            // if (startAMPM.toLowerCase() == "am" && startHours == 12) startHours = startHours - 12;

            if (endAMPM.toLowerCase() == "pm" && endHours >= 12) endHours = endHours - 12;
            // if (endAMPM.toLowerCase() == "am" && endHours == 12) endHours = endHours - 12;

            //add extra 0 for minute field values that are between 0 and 9
            
            if(startMinutes<=9){
                startMinutes='0'+startMinutes;
            }
            if(endMinutes<=9){
                endMinutes='0'+endMinutes;
            }

            //build time_range from start_time and end_time fields
            document.getElementById('time_range').value=startHours+":"+startMinutes+" "+startAMPM+"-"+endHours+":"+endMinutes+" " + endAMPM;

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

@else

    <script>window.open('/','_self');</script>

@endif