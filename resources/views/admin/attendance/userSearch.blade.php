@extends('layouts.app')

@section('content')

<table class="table table-responsive table-bordered">
    @foreach($userInfo as $u)
        <tr>
            {{$u->username}}
        </tr>
    @endforeach
</table>
@endsection