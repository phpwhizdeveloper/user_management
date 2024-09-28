@extends('layout.app')
@section('content')
    <div class="card m-5 p-3">
        <form method="post" action="/category/add">
            @csrf
            <input type="hidden" name="id" value="{{$category->id ?? ''}}">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="category_name" value="{{$category->category_name ?? ''}}" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </form>
    </div>
@endsection