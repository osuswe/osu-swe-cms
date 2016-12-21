@if(isset($_SESSION['admin']))



    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Event {{ $event->id }}
        <a href="{{ url('admin/events/' . $event->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Event"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/events', $event->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Event',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $event->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $event->title }} </td></tr>
                <tr><th> Date </th><td> {{ $event->date }} </td></tr>
                <tr><th> Location </th><td> {{ $event->location }} </td></tr>
                <tr><th> Description </th><td> {{ $event->description }} </td></tr>
                <tr><th> Time Range </th><td> {{ $event->time_range }} </td></tr>
                <tr><th> Event Code </th><td> {{ $event->event_code }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif