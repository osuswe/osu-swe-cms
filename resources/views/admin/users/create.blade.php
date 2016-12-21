@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create New User</h1>
        <hr/>

        {!! Form::open(['url' => '/admin/users', 'class' => 'form-horizontal']) !!}
        <div class="form-group {{ $errors->has('firstName') ? 'has-error' : ''}}">
            {!! Form::label('firstName', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('firstName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('firstName', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('lastName') ? 'has-error' : ''}}">
            {!! Form::label('lastName', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('lastName', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('lastName', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('password', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'passwordBox', 'readonly' => 'readonly']) !!}
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('officer') ? 'has-error' : ''}}">
            {!! Form::label('officer', 'Officer', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <div class="checkbox">
                    <label>{!! Form::radio('officer', '1') !!} Yes</label>
                </div>
                <div class="checkbox">
                    <label>{!! Form::radio('officer', '0', true) !!} No</label>
                </div>
                {!! $errors->first('officer', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('graduationYear') ? 'has-error' : ''}}">
            {!! Form::label('graduationYear', 'Graduation Year', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('graduationYear', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('graduationYear', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('major') ? 'has-error' : ''}}">
            {!! Form::label('major', 'Major', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <select id="selectMajor">
                    <option value="Aeronautical and Astronautical Engineering" selected>Aeronautical and
                        Astronautical Engineering
                    </option>
                    <option value="Architecture">Architecture</option>
                    <option value="Aviation">Aviation</option>
                    <option value="Biomedical Engineering">Biomedical Engineering</option>
                    <option value="Chemical Engineering">Chemical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                    <option value="Electrical and Computer Engineering">Electrical and Computer Engineering</option>
                    <option value="Engineering Physics">Engineering Physics</option>
                    <option value="Environmental Engineering"> Environmental Engineering</option>
                    <option value="Faculty/staff"> Faculty/staff</option>
                    <option value="Food, Agricultural and Biological Engineering"> Food, Agricultural and Biological
                        Engineering
                    </option>
                    <option value="Industrial and Systems Engineering">Industrial and Systems Engineering</option>
                    <option value="Materials Science and Engineering">Materials Science and Engineering</option>
                    <option value="Mechanical Engineering"> Mechanical Engineering</option>
                    <option value="Non-Engineering"> Non-Engineering</option>
                    <option value="Undecided Engineering">Undecided Engineering</option>
                    <option value="Welding Engineering">Welding Engineering</option>
                </select>

                <br><br>
                {!! Form::text('major', null, ['class' => 'form-control', 'required' => 'required', 'id'=>'majorBox']) !!}
                {!! $errors->first('major', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            {!! Form::label('phone', 'Phone #', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
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
            var selectMajor = document.getElementById('selectMajor');
            var passwordBox = document.getElementById('passwordBox');

            //set static password for all users
            passwordBox.value = "osu-swe";

            var majorBox = document.getElementById('majorBox');

            //init major box value
            majorBox.value = selectMajor.options[selectMajor.selectedIndex].value;

            //majorBox=selectMajor.options[selectMajor.selectedIndex].value;
            selectMajor.onchange = function () {
                majorBox.value = selectMajor.options[selectMajor.selectedIndex].value;
            };
        };
    </script>
@endsection