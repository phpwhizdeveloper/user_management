@extends('layout.app')
@section('content')
    <a href="/image/add">Add</a>
    <a href="/category/list">Category</a>

    <div class="imageBlock2 d-none"></div>
    <div class="m-3">
        <label class="form-label">Select Your Category</label>
        <select class="form-control" id="categoryId">
            <option value="0">Select your category</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="m-3">
        <label class="form-label">Select your start date</label>
        <input type="date" name="start_date" id="startDate">
    </div>
    <div class="m-3">
        <label class="form-label">Select your end date</label>
        <input type="date" name="end_date" id="endDate">
    </div>
   
    <div class="m-5 p-3 imageBlockMain">
       
        @foreach ($images as $image)
            <div class="responsive">
                <div class="gallery">
                    <a href='/image/delete/{{$image->id}}'>Delete</a>
                    <a target="_blank" href="{{ asset($image->image_path) }}" data-lightbox="image-1" >
                        <img src="{{ asset($image->image_path) }}" alt="Forest" max-width="600" max-height="400" data-lightbox="roadtrip">
                    </a>
                    <div class="desc">Image Name{{ $image->image_name }} <br> Category Name:
                        {{ $image->category->category_name }}</div>
                </div>
            </div>
        @endforeach

        <div class="clearfix"></div>
        {{ $images->links() }}

    </div>
    <script>
        $(document).ready(function () {
            var category = 0;
            var startDate = "";
            var endDate = '';
            var page = 0;

            $("body").on("change","#categoryId",function(e){
                e.preventDefault();
                category = this.value;
                getImages();
            });
            $("body").on("change","#startDate",function(e){
                e.preventDefault();
                startDate = this.value;
                getImages();

            });
            $("body").on("change","#endDate",function(e){
                e.preventDefault();
                endDate = this.value;
                getImages();

            });

            function getImages(){
                $.ajax({
                    type: "POST",
                    url: "/image/get/",
                    data: { 
                        "_token": "{{ csrf_token() }}",
                        category: category,
                        startDate: startDate,
                        endDate: endDate 
                    },
                    success: function(result) {
                        // $(".imageBlock2").html(result);
                        // successHtml=$(".imageBlock2 .imageBlockMain").html();
                        // $(".imageBlock2").html("");
                        // $(".imageBlockMain").html(successHtml)
                    },
                    error: function(result) {
                        alert('error');
                    }
                });
            }
        });
    </script>
@endsection
