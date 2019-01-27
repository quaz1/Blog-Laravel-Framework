@extends('layouts.app')
<style type="text/css">
    .avatar{
      border-radius: 100%;
      max-width: 80px;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if(count($errors) > 0 )
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger">{{$error}}</div>
              @endforeach
          @endif
          <div class="panel-body">
              @if (session('response'))
                  <div class="alert alert-success">
                      {{ session('response') }}
                  </div>
              @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-4">
                    My Profile
                    </div>
                    <div class="col-md-8">
                      <form action='{{url("/search")}}' method="POST">
                      {{ csrf_field() }}
                        <div class="input-group">
                          <input type="text" name="search" class="form-control"
                          placeholder="Search...">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-default">
                              Search</button>
                            </span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                    @if(!empty($profile))
                        <img src ="{{ $profile->profile_pic }}" class ="avatar" alt=""/>
                    @else
                        <img src ="{{ url('images/avatar.png') }}" class ="avatar" alt=""/>
                    @endif

                    @if(!empty($profile))
                        <p class="lead">{{ $profile->name }} </p>
                    @else
                      <p></p>
                    @endif
                    @if(!empty($profile))
                        <p class="lead">{{ $profile->designation }} </p>
                    @else
                        <p> </p>
                    @endif
                    </div>
                    <div class="col-md-8">
                        @if(count($posts)>0)
                            @foreach($posts->all() as $post)
                                <h4><b>{{$post->post_title}}</b></h4>
                                <img src="{{ $post->post_image }}" alt="">
                                <p>{{substr($post->post_body, 0, 100)}}</p>

                                <ul class="nav nav-pills">
                                  <li role="presentation">
                                    <a href='{{url("/view/{$post->id}")}}'>
                                      <span class=""> View </span>
                                    </a>
                                  </li>
                                  @if(Auth::id() == 1)
                                  <li role="presentation">
                                    <a href='{{url("/edit/{$post->id}")}}'>
                                      <span class=""> Edit </span>
                                    </a>
                                  </li>
                                  <li role="presentation">
                                    <a href='{{url("/delete/{$post->id}")}}'>
                                      <span class=""> Delete </span>
                                    </a>
                                  </li>
                                  @endif

                                </ul>

                                <cite style="float:left;">Published On :
                                  {{date('M j, Y, H:i', strtotime($post->updated_at))}}</cite>
                                <hr/>
                            @endforeach
                        @else
                                <p>No post uploaded</p>
                        @endif

                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
