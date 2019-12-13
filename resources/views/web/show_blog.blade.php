@extends('layout.template')
@section('content')


<section class="page-section" id="contact">
    <div class="container">
        <br>

      <!-- Contact Section Heading -->
     

      <!-- Contact Section Form -->
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
          <!-- <h2></h2> -->
          <div class="card mb-3">
          <img class="img-fluid" src="{{asset('storage/uploads/blog/'.$blog->image)}}" alt="">
  <div class="card-body">
    <h5 class="card-title">{{$blog->blog_title}}</h5>
    <p class="card-text">{{$blog->blog_description}}.</p>
    <p class="card-text"><small class="text-muted">Created at {{$blog->created_at}}</small></p>
  </div>
</div>

  
            
        </div>
      </div>

    </div>
  </section>




@endsection
  