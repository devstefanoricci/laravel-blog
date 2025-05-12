@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit post') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb">
                                <label for="exampleFormControlInput1" class="form-label">Categories</label>
                                <select class="form-select" aria-label="Default select example" name="category_id" onselect="">
                                    <option selected value="0">---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($post->category_id == $category->id)
                                                selected
                                            @endif
                                            >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{ $post->title }}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content">{{$post->content}}></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="formFileLg" class="form-label">Image</label>
                                <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
