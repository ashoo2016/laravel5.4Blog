@extends('layouts.app')
<style>
    .avtar{
        border-radius:100%;
        max-width: 100px;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(count($errors) > 0)
                   @foreach($errors->all() as $error)
                   <div class = "alert alert-danger">{{$error}}</div>
                   @endforeach
                @endif

                @if(session('response'))
                <div class = "alert alert-success">{{session('response')}}</div>
                @endif
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                  <div class = "row">
                      <div class = "col-md-4">
                        Dashboard
                      </div>
                    <div class = "col-md-8">
                         <form method = "POST" action = '{{ url("/search")}}'>
                        {{ csrf_field() }}
                                <div class = "input-group">
                                  <input type = "text" name = "search" class = "form-control" placeholder="Search for...">
                                  <span class = "input-group-btn">
                                    <button type = "submit" class=" btn btn-default">
                                      Go
                                    </button>
                                  </span>
                                </div>
                           </form>
                      </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="col-md-4">
                        @if(!empty($profile))
                        <img src= "{{$profile ->profile_pic}}" class="avtar" alt="" />
                        @else
                        <img src= "{{url('images/avtar.png')}}" class="avtar" alt="" />
                        @endif
                        @if(!empty($profile))
                        <p class = "lead text-primary">{{$profile ->name}}</p>
                        @else
                        <p></p>
                        @endif
                        @if(!empty($profile))
                        <p class = "lead text-primary">{{$profile ->designation}}</p>
                        @else
                        <p></p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        @if(count($posts) > 0)
                          @foreach($posts->all() as $post)
                          <h4 class = "lead">{{ $post->post_title}}</h4>
                          <img src = "{{ $post->post_image }}" alt = "">
                          <hr/>
                          <p class="text-justify lead">{{ substr($post->post_body , 0 , 150) }}</p>
                          <ul class = "nav nav-pills">
                              <li role = "presentation">
                                <a href= '{{ url("/view/{$post->id}")}}'>
                                    <span class ="fa fa-eye"> View</span>
                                </a>
                                  
                              </li>
                               @if(Auth::id() == 1)
                                  <li role = "presentation">
                                    <a href= '{{ url("/edit/{$post->id}")}}'>
                                        <span class ="fa fa-pencil-square-o"> Edit</span>
                                    </a>
                                      
                                  </li>
                                  <li role = "presentation">
                                     <a href= '{{ url("/delete/{$post->id}")}}'>
                                        <span class ="fa fa-trash"> Delete</span>
                                    </a>
                                      
                                  </li>
                              @endif

                          </ul>
                          <cite>Posted on :{{ date('M d ,Y H:i' ,strtotime($post->updated_at))}}</cite>
                          <hr/>
                          @endforeach
                        @else
                        <p>No Posts Availaible !!</p>
                        @endif
                        
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
