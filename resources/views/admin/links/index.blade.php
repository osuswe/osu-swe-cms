@if(isset($_SESSION['admin']))



    @extends('layouts.app')

@section('content')
<div class="container">

    <h1>Links <a href="{{ url('/admin/links/create') }}" class="btn btn-primary btn-xs" title="Add New Link"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Link </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($links as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->link }}</td>
                    <td>
                        <a href="{{ url('/admin/links/' . $item->id) }}" class="btn btn-success btn-xs" title="View Link"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/links/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Link"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/links', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Link" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Link',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $links->render() !!} </div>
    </div>

</div>
@endsection

@else

    <script>window.open('/','_self');</script>

@endif
