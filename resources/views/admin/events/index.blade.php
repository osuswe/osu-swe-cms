@if(isset($_SESSION['admin']))
<style type="text/css">


    html, td{
        font-size: 14px;
    }

    td{
        word-break: break-all;
    }

    /*.description{*/
        /*max-width: 250px;*/
    /*}*/

    /*.titleLink{*/
        /*max-width: 200px;*/
    /*}*/
</style>


    @extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Events <a href="{{ url('/admin/events/create') }}" class="btn btn-primary btn-xs"
                      title="Add New Event"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th> Id</th>
                    <th> Title</th>
                    <th> Date</th>
                    <th> Location</th>
                    <th> Description</th>
                    <th> Time Range</th>
                    <th> Event Code</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($events as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td class="col-lg-1">{{ $item->id }}</td>
                        <td class="titleLink col-lg-2" id="{{$item->id}}">{{ $item->title }}</td>
                        <td class="col-lg-1">{{ $item->date }}</td>
                        <td class="col-lg-2">{{ $item->location }}</td>
                        <td class="col-lg-3">{{ $item->description }}</td>
                        <td class="col-lg-2">{{ $item->time_range }}</td>
                        <td class="col-lg 1">{{ $item->event_code }}</td>
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
        <br>
    <div id="eventUserList">
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
                var title=$(this);
                var eventId = title.attr("id");
                $.ajax({
                    url: "{{url("admin/get/allAttendees")}}",
                    type: "POST",
                    data: {eventId: eventId},
                    success: function (data) {
                        console.log(data);
                        var html="";
                        html+="<h2>"+ title.text()+" attendance</h2><table class='table table-bordered table-striped table-hover'>" +
                                "<tr>" +
                                "<th>First Name</th>" +
                                "<th>Last Name</th>" +
                                "<th>Username</th>"
                                "</tr>";
                        var array=JSON.parse(data);
                        if(array.length==0){
                            html+="No attendance for this event";
                        }
                        else{
                            for(var i=0;i<array.length;i++){
                                html+="<tr>" +
                                        "<td>"+array[i].firstName+"</td>" +
                                        "<td>"+array[i].lastName+"</td>" +
                                        "<td>"+array[i].username+"</td>" +
                                        "</tr>";
                            }
                            html+="<tr><th>Total Attendance</th>" +
                                    "<td>"+array.length+"</td></tr>";

                        }
                        html+="</table>";
                        $("#eventUserList").html(html);
                    },
                    error: function (err) {
                        console.log(err.responseText);
                    }

                });

            });


        });
    </script>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif