@extends('layout')

@section('content')
    <div>
        <div>
            <h1>Top 10 Most Famous Author</h1>
        </div>
        <div>
            <table>
                <tr>
                    <th>No</th>
                    <th>Author Name</th>
                    <th>Voter</th>
                </tr>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $author->author->name }}</td>
                        <td>{{ $author->total_rating_voters }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection