@extends('app');

@section('tittle')
    Books List
@stop

@section('content')

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->genre }}</td>

                <td>
                    <a href="{{ URL::to('books/' . $book->id) }}" class="btn btn-success">Show</a>
                    <a href="{{ URL::to('books/' . $book->id . '/edit') }}" class="btn btn-info">Edit</a>
                    <a href="{{ URL::to('books/' . $book->id . '/users') }}" class="btn btn-warning">Add to User</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $books->render() !!}

@stop