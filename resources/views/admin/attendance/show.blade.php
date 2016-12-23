@if(isset($_SESSION['admin']))



    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Attendance {{ $attendance->id }}
        <a href="{{ url('admin/attendance/' . $attendance->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Attendance"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/attendance', $attendance->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Attendance',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $attendance->id }}</td>
                </tr>
                <tr><th> User Id </th><td> {{ $attendance->user_id }} </td></tr><tr><th> Event Id </th><td> {{ $attendance->event_id }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif