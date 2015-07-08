@extends('app');

@section('tittle')
    Show User
@stop

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">First Name:</h3>
        </div>
        <div class="panel-body">
            {{$user->firstname}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Last Name:</h3>
        </div>
        <div class="panel-body">
            {{$user->lastname}}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">E-Mail:</h3>
        </div>
        <div class="panel-body">
            {{$user->email}}
        </div>
    </div>


@stop