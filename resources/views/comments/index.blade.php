@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $note)
                        <tr>
                            <td>{{ $note->id }}</td>
                            <td><a href="{{ route('notes.show', $note->id) }}">{{ $note->title }}</a></td>
                            <td>{{ $note->body }}</td>
                            <td>{{ $note->created_at }}</td>
                            <td>{{ $note->updated_at }}</td>
                            <td>
                                <div class="col-auto">
                                    <a href="{{ route('notes.show', $note->id) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $notes->links() }}
        </div>
    @endsection
