@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Attendance <a href="{{ url('/admin/attendance/create') }}" class="btn btn-primary btn-xs" title="Add New Attendance"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> User Id </th><th> Event Id </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($attendance as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->user_id }}</td><td>{{ $item->event_id }}</td>
                    <td>
                        <a href="{{ url('/admin/attendance/' . $item->id) }}" class="btn btn-success btn-xs" title="View Attendance"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/attendance/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Attendance"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/attendance', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Attendance" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Attendance',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $attendance->render() !!} </div>
    </div>

</div>
@endsection
