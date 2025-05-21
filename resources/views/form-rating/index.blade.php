@extends('layout')

@section('content')
    <div>
        <div>
            <h3>Insert Rating</h3>
        </div>
        <div style="border: 1px solid black; padding: 10px;">
            <form action="/add-rating" method="POST">
                @csrf
                <div class="input-form">
                    <label for="author">Author : </label>
                    <select name="author_id" id="author">
                        <option value="">Select Author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-form">
                    <label for="book">Book:</label>
                    <select id="book" name="book_id">
                        <option value="">Select Book</option>
                    </select>
                </div>
                <div class="input-form">
                    <label for="rating">Rating :</label>
                    <select id="rating" name="rating">
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('author').addEventListener('change', function () {
            const authorId = this.value;
            const bookSelect = document.getElementById('book');
            
            if (!authorId) {
                bookSelect.innerHTML = '<option value="">Select Book</option>';
                return;
            }

            bookSelect.innerHTML = '<option>Loading...</option>';

            fetch(`/form-rating/${authorId}`)
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    bookSelect.innerHTML = '';
                    data.forEach(book => {
                        const option = document.createElement('option');
                        option.value = book.id;
                        option.textContent = book.title;
                        bookSelect.appendChild(option);
                    });
                });
        });
    </script>
@endsection


