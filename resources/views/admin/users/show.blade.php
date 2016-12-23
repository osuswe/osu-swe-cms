@if(isset($_SESSION['admin']))


    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>User {{ $user->id }}
        <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/users', $user->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $user->id }}</td>
                </tr>
                <tr><th> First Name </th><td> {{ $user->firstName }} </td></tr>
                <tr><th> Last Name </th><td> {{ $user->lastName }} </td></tr>
                <tr><th> Username </th><td> {{ $user->username }} </td></tr>
                <tr><th> Password </th><td> {{ $user->password }} </td></tr>
                <tr><th> Officer </th><td> {{ $user->officer }} </td></tr>
                <tr><th> Major </th><td> {{ $user->major }} </td></tr>
                <tr><th> Phone # </th><td> {{ $user->phone }} </td></tr>
                <tr><th> Graduation Year </th><td> {{ $user->graduationYear }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif