@extends('app')

@section('tittle', 'User List')

@section('content')

    <table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>E.Mail</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    <a href="{{ URL::to('users/' . $user->id) }}" class="btn btn-success">Show</a>
                    <a href="{{ URL::to('users/' . $user->id . '/edit') }}" class="btn btn-info">Edit</a>
                    <a href="{{ URL::to('users/' . $user->id . '/books') }}" class="btn btn-warning">Have Books</a>

                    {!! Form::open( ['url' => 'users/'. $user->id, 'class' => 'pull-right'] ) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::submit('Delete this User', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

    {!! $users->render() !!}

@stop