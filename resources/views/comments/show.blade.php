@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Image</th>
        <th scope="col">Author</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$note->id}}</td>
        <td>{{$note->title}}</td>
        <td>{{$note->body}}</td>
        <td><img src="{{ Storage::url($note->image_url) }}"  class="" alt="" width="200" /></td>
        <td>{{$note->user->email}}</td>
        <td>{{$note->created_at}}</td>
        <td>{{$note->updated_at}}</td>
        <td><a href="{{ url()->previous() }}" class="btn btn-secondary">Indietro</td>
      </tr>
    </tbody>
  </table>

  @endsection








