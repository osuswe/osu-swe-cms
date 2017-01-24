@if(isset($_SESSION['admin']))

    @extends('layouts.app')

@section('content')

    <?php
    $timeArray = explode('-', $event->time_range);
    echo "<script>
    var timeArray = " . json_encode($timeArray) . ";


    </script>";

    ?>

    <script>
        window.onload = function () {

            initTimes();

        };

        function initTimes(){
            //get start time
            var startTimeAMPMSplit = timeArray[0].split(' ');
            var startHoursMinutesSplit = startTimeAMPMSplit[0].split(':');

            //get end time
            var endTimeAMPMSplit = timeArray[1].split(' ');
            var endHoursMinutesSplit = endTimeAMPMSplit[0].split(':');

            //convert hours to correct 24 time to put back into input fields

            if (parseInt(startHoursMinutesSplit[0]) < 12 && startTimeAMPMSplit[1] == 'pm') {
                startHoursMinutesSplit[0] = parseInt(startHoursMinutesSplit[0]) + 12;
            }

            if (parseInt(endHoursMinutesSplit[0]) < 12 && endTimeAMPMSplit[1] == 'pm') {
                endHoursMinutesSplit[0] = parseInt(endHoursMinutesSplit[0]) + 12;
            }

            if(parseInt(startHoursMinutesSplit[0]) == 12 && startTimeAMPMSplit[1] == 'am'){
                startHoursMinutesSplit[0] = "00";
            }

            if(parseInt(endHoursMinutesSplit[0]) == 12 && endTimeAMPMSplit[1] == 'am'){
                endHoursMinutesSplit[0] = "00";
            }



            document.getElementById('start_time').value = startHoursMinutesSplit[0] + ':' + startHoursMinutesSplit[1];
            document.getElementById('end_time').value = endHoursMinutesSplit[0] + ':' + endHoursMinutesSplit[1];
        }

        function setEventObj() {

            //get start time
            var startTimeAMPMSplit = document.getElementById('start_time').value.split(' ');
            var startHoursMinutesSplit = startTimeAMPMSplit[0].split(':');

            //get end time
            var endTimeAMPMSplit = document.getElementById('end_time').value.split(' ');
            var endHoursMinutesSplit = endTimeAMPMSplit[0].split(':');

            //convert hours back to correct 12 hour time to put back into input fields
            var startAMPM, endAMPM;

            //start time corrections

            if(parseInt(startHoursMinutesSplit[0]) == 12){
                startAMPM = 'pm';
            }

            else if (parseInt(startHoursMinutesSplit[0]) > 12) {
                startHoursMinutesSplit[0] = parseInt(startHoursMinutesSplit[0]) - 12;
                startAMPM = 'pm';
            }

            else{
                startAMPM = 'am';
            }

            if(parseInt(startHoursMinutesSplit[0]) == 0){
                startHoursMinutesSplit[0] = 12;
            }


            //end time corrections

            if(parseInt(endHoursMinutesSplit[0]) == 12){
                endAMPM = 'pm';
            }

            else if (parseInt(endHoursMinutesSplit[0]) > 12) {
                endHoursMinutesSplit[0] = parseInt(endHoursMinutesSplit[0]) - 12;
                endAMPM = 'pm';
            }

            else{
                endAMPM = 'am';
            }

            if(parseInt(endHoursMinutesSplit[0]) == 0){
                endHoursMinutesSplit[0] = 12;
            }


            //construct and assign time_range string
            document.getElementById('time_range').value = startHoursMinutesSplit[0] + ':' + startHoursMinutesSplit[1]
                + ' ' + startAMPM +  '-' + endHoursMinutesSplit[0] + ':' + endHoursMinutesSplit[1]
                + ' ' + endAMPM;

            console.log(document.getElementById('time_range').value);
            document.getElementsByTagName('form')[0].submit();
        };
    </script>


    <div class='container'>

        <h1>Edit Event {{ $event->id }}</h1>

        {!! Form::model($event, [
            'method' => 'PATCH',
            'url' => ['/admin/events', $event->id],
            'class' => 'form-horizontal'
        ]) !!}

        <div class='form-group {{ $errors->has('title') ? 'has-error' : ''}}'>
            {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class='form-group {{ $errors->has('date') ? 'has-error' : ''}}'>
            {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class='form-group {{ $errors->has('location') ? 'has-error' : ''}}'>
            {!! Form::label('location', 'Location', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class='form-group {{ $errors->has('description') ? 'has-error' : ''}}'>
            {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class='form-group'>
            {!! Form::label('start_time', 'Start Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::time('start_time', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'start_time',
                'value' => '' ]) !!}
            </div>
        </div>
        <div class='form-group'>
            {!! Form::label('end_time', 'End Time', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::time('end_time', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'end_time']) !!}
            </div>
        </div>
        <div class='form-group {{ $errors->has('event_code') ? 'has-error' : ''}}'>
            {!! Form::label('event_code', 'Event Code', ['class' => 'col-sm-3 control-label']) !!}
            <div class='col-sm-6'>
                {!! Form::text('event_code', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('event_code', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class='form-group'>
            <div class='col-sm-offset-3 col-sm-3'>
                {!! Form::button('Update', ['class' => 'btn btn-primary form-control', 'onclick'=>'setEventObj()']) !!}
            </div>
        </div>
        <input type='hidden' id='time_range' name='time_range' required/>
        {!! Form::close() !!}

        @if ($errors->any())
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection

@else

    <script>window.open('/', '_self');</script>

@endif