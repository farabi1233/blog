@extends('layout.template')

@section('content')




<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
      <br>

      <!-- About Section Heading -->
      <h2 class="page-section-heading text-center text-uppercase text-white">All_data</h2>


      <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Blog Title</th>
      <th scope="col">Blog Description</th>
      <th scope="col">Catagory Name</th
      <th scope="col">Acton</th>
    </tr>
  </thead>
  @foreach($blogs as $blog)
    <tr>
      <th scope="row">{{$blog->id}}</th>
      <td>{{$blog->blog_title}}</td>
      <td>{{substr($blog->blog_description,0,150)}}</td>
      <td>{{$blog->category->category_name}}</td>
      
      <td><a href="{{route('blog.edit',$blog->id)}}"><button type="button" class="btn btn-primary">Edit</button></a></td>
      <td><button type="button" class="btn btn-outline-danger">Delete</button></td>
      
    </tr>
    @endforeach
    
 
</table>

     
      

    </div>
  </section>


@endsection