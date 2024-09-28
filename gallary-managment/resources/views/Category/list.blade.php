@extends('layout.app')
@section('content')
    <div class="card m-5 p-3">
        <a href="/category/add">Add</a>

        <table class="table">
            <tr>
                <td>Category Name</td>
                <td>Action</td>
            </tr>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->category_name}}</td>
                <td>
                    <a href="/category/edit/{{$category->id}}">Edit</a>
                    <a href="/category/delete/{{$category->id}}">Delete</a>

                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection