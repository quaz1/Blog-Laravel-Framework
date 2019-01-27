@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if (session('response'))
              <div class="alert alert-success">
                  {{ session('response') }}
              </div>
          @endif
            <div class="panel panel-default">
                <center><div class="panel-heading">Post View</div> </center>
                <hr/>
                <div class="panel-body">
                    <div class="col-md-4">
                      <ul class="list-group">
                        @if(count($categories) > 0)
                            @foreach($categories->all() as $category)
                              <li class="list-group-item"><a href='{{url("category/{$category->id}")}}'>
                                {{$category->category}} </a></li>
                            @endforeach
                        @else
                          <p>""</p>
                        @endif
                      </ul>
                    </div>
                    <div class="col-md-8">
                        @if(count($posts)>0)
                            @foreach($posts->all() as $post)
                                <h4><b>{{$post->post_title}}</b></h4>
                                <img src="{{ $post->post_image }}" alt="">
                                <p>{{$post->post_body }}</p>

                                <ul class="nav nav-pills">
                                  <li role="presentation">
                                    <a href='{{url("/like/{$post->id}")}}'>
                                      <span class=""> Upvote ({{$likeCtr}})</span>
                                    </a>
                                  </li>
                                  <li role="presentation">
                                    <a href='{{url("/dislike/{$post->id}")}}'>
                                      <span class=""> Down-vote ({{$dislikeCtr}})</span>
                                    </a>
                                  </li>
                                  <li role='{{url("/comment/{$post->id}")}}'>
                                    <a href="">
                                      <span class=""> Comment </span>
                                    </a>
                                  </li>
                                </ul>


                            @endforeach
                        @else
                                <p>No post uploaded</p>
                        @endif
                        <form method="POST" action='{{url("/comment/{$post->id}")}}'>
                        {{csrf_field()}}
                            <div class="form-group">
                              <textarea id="comment" rows="6" class="form-control"
                              name="comment" required autofocus></textarea>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-success btn-lg btn-block">
                              Post Comment</button>
                            </div>
                        </form>
                        <center><h3>Comments</h3></center>
                        @if(count($comments)>0)
                            @foreach($comments->all() as $comment)
                                <p>{{$comment->comment}}</p>
                                <p>Posted By: <b>{{$comment->name}}</b></p>
                                <hr/>
                            @endforeach
                        @else
                            <p>No post uploaded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
