@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Events <a href="{{ url('/admin/events/create') }}" class="btn btn-primary btn-xs"
                      title="Add New Event"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th> Title</th>
                    <th> Date</th>
                    <th> Location</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($events as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $x }}</td>
                        <td id="{{$item->id}}" class="titleLink">{{ $item->title }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->location }}</td>
                        <td>
                            <a href="{{ url('/admin/events/' . $item->id) }}" class="btn btn-success btn-xs"
                               title="View Event"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                            <a href="{{ url('/admin/events/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                               title="Edit Event"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/admin/events', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Event" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Event',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $events->render() !!} </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            /*
             Display accordion of all users who attended event on click;
             Also show event totals.
             */

            $(".titleLink").click(function () {
                var eventId = $(this).attr("id");
                $.ajax({
                    url: "{{url("admin/get/allAttendees")}}",
                    type: "POST",
                    data: {eventId: eventId},
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (err) {
                        console.log(err.responseText);
                    }

                });

            });


        });
    </script>
@endsection
