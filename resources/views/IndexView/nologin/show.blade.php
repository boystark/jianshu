@extends("IndexView.nologin.common")

@section("content")

    <section class="col-md-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="/login">{{$post->user->name}}</a></p>

            {!! $post->content !!}

            <div>

                <a href="/login" type="button" class="btn btn-primary btn-lg">赞</a>

            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>
            <!-- List group -->
            <ul class="list-group">

                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at->toFormattedDateString()}} --by-- {{$comment->user->name}}</h5>
                        <div>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </section>

@endsection