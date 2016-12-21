@if(isset($_SESSION['admin']))



    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Link {{ $link->id }}
        <a href="{{ url('admin/links/' . $link->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Link"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/links', $link->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Link',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $link->id }}</td>
                </tr>
                <tr><th> Link </th><td> {{ $link->link }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif
