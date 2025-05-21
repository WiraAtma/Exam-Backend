@extends('layout')

@php
    $search = request('search');
    $list = request('list');
@endphp

@section('content')
    <div>
        <div>
            <form action="">
                <div class="input-form">
                    <label for="list">List shown : </label>
                    <select name="list" id="list">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="input-form">
                    <label for="search">Search :</label>
                    <input name="search" id="search" placeholder="Search Book & Author" type="text">
                </div class="input-form">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div>
            <p>Your Search : {{ $search ?: "empty" }}</p>
            <p>List shown : {{ $list ?: 10 }}</p>
            @if (session('success'))
                <div style="margin: 5px 0; color: green;">
                    {{ session('success') }}
                </div>
            @endif
            <table>
                <tr>
                    <th>No</th>
                    <th>Book Name</th>
                    <th>Category Name</th>
                    <th>Author Name</th>
                    <th>Average Rating</th>
                    <th>Voter</th>
                </tr>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->average_rating }}</td>
                        <td>{{ $book->rating_voter }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $books->links() }}
        </div>
    </div>
@endsection
