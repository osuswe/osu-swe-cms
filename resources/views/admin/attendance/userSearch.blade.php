@extends('layouts.app')

@section('content')
    <h2>User Search Results</h2>
    <table class="table table-responsive table-bordered">
        <tr>
            <th>Id</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Total Attendance</th>
        </tr>
        <tr>
            <td>{{$userInfo->id}}</td>
            <td>{{$userInfo->firstName}}  {{$userInfo->lastName}}</td>
            <td>{{$userInfo->username}}</td>
            <td>{{count($events)}}</td>
        </tr>

    </table>
    <h2>Events {{$userInfo->firstName}}  {{$userInfo->lastName}} has attended</h1>
    <br>
    <table class="table table-responsive table-bordered">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Time Range</th>
        </tr>
        @foreach($events as $event)

        <tr>
            <td>{{$event->id}}</td>
            <td>{{$event->title}}</td>
            <td>{{$event->date}}</td>
            <td>{{$event->location}}</td>
            <td>{{$event->time_range}}</td>


        </tr>

            @endforeach

    </table>
@endsection