@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
               @if(session('response'))
                <div class = "alert alert-success">{{session('response')}}</div>
                @endif
            <div class="panel panel-default text-center">
                <div class="panel-heading ">Post View</div>

                <div class="panel-body">
                    <div class="col-md-4">
                       <ul class="list-group">
                        @if(count($categories) > 0)
                            @foreach($categories ->all() as $category)
                            <li class="list-group-item"><a href = '{{url ("category/{$category ->id}")}}'>{{$category ->category}}</a></li>
                            @endforeach

                        @else
                        <p>No Category Found !!</p>
                        @endif
                        
                      </ul>
                        
                    </div>
                    <div class="col-md-8">
                        @if(count($posts) > 0)
                          @foreach($posts->all() as $post)
                          <h4>{{ $post->post_title}}</h4>
                          <img src = "{{ $post->post_image }}" alt = "">
                          <hr/>
                          <p class ="text-justify lead">{{ $post->post_body  }}</p>
                          <ul class = "nav nav-pills">
                              <li role = "presentation">
                                <a href= '{{ url("/like/{$post->id}")}}'>
                                    <span class ="fa fa-thumbs-up">  {{ $likeCtr }}</span>
                                </a>
                                  
                              </li>
                              <li role = "presentation">
                                <a href= '{{ url("/dislike/{$post->id}")}}'>
                                    <span class ="fa fa-thumbs-down">{{ $dislikeCtr }}</span>
                                </a>
                                  
                              </li>
                              <li role = "presentation"  >
                                 <a href= ''>
                                    <span class ="fa fa-comment-o" id = "myDiv" > Comment</span>
                                </a>
                                  
                              </li>

                          </ul>
                          
                          @endforeach
                        @else
                        <p>No Posts Availaible !!</p>
                        @endif
                        
                        <div  id = "commentDiv" >
                        <form method = "POST" action = '{{ url("comment/{$post->id}")}}' >
                          {{ csrf_field()}}
                          <div class = "form-group">
                            <textarea id = "comment" rows = "2" class = "form-control" name = "comment" required autofocus>
                            </textarea>
                          </div> 
                          <div class = "form-group">
                            <button type = "submit" class = "btn btn-success btn-lg btn-block">
                            POST COMMENT
                          </div>
                        </form>
                      </div>
                        <h4><strong>Recent Comments:</strong></h4>
                        @if(count($comments) > 0)
                           @foreach($comments->all() as $comment)
                          <!-- <p class="text-primary">{{ $comment->comment }}</p> -->
                           <blockquote class="blockquote">
                                <p class="text-primary">{{ $comment->comment }}</p>
                                <footer class="blockquote-footer text-right">{{ $comment->name }} on {{ $comment->created_at }}</footer>
                          </blockquote>
                                                   <!--  <p>Posted By: {{ $comment->name }} on {{ $comment->created_at }} </p> -->
                           @endforeach


                        @else
                          <p>No Comments Availaible !!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(
    function(){
        $("#myDiv").click(function () {
         // alert('sjcsc');
            $("#commentDiv").show("slow");
        });

    });
</script>
@endsection

