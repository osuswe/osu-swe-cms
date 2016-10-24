@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Users <a href="{{ url('/admin/users/create') }}" class="btn btn-primary btn-xs" title="Add New User"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Username </th>
                    <th> Password </th>
                    <th> Officer </th>
                    <th> Major </th>
                    <th> Phone # </th>
                    <td> Graduation Year</td>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->firstName }}</td>
                    <td>{{ $item->lastName }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->password }}</td>
                    <td>{{ $item->officer }}</td>
                    <td>{{ $item->major }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->graduationYear }}</td>
                    <td>
                        <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/users', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
    </div>

</div>
@endsection
