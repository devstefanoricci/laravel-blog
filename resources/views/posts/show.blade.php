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
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td><img src="{{ Storage::url($post->image_url) }}"  class="" alt="" width="200" /></td>
        <td>{{$post->user->email}}</td>
        <td>{{$post->created_at}}</td>
        <td>{{$post->updated_at}}</td>
        <td><a href="{{ url()->previous() }}" class="btn btn-secondary">Indietro</td>
      </tr>
    </tbody>
  </table>

  @endsection








