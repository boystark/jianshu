@extends("IndexView.layout.main")

@section("content")

    <section class="col-md-8">
        <blockquote>
            <p><img src="" alt="无图:" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>
            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            @include('IndexView.user.badges.like',['target_user'=>$user])
        </blockquote>
    </section>

    <section class="col-md-8 blog-main">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <!-- 文章 -->
                <section class="tab-pane active" id="tab_1">
                   @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                        <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>


                        {!! str_limit($post->content,100,'...') !!}
                    </div>
                   @endforeach
                </section>
                <!-- 关注 -->
                <section class="tab-pane" id="tab_2">
                    @foreach($susers as $user)
                    <div class="blog-post" style="margin-top: 30px">
                        <p>{{$user->name}}</p>
                        <p>关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>
                    @include('IndexView.user.badges.like',['target_user'=>$user])
                    </div>
                    @endforeach
                </section>
                <!-- 粉丝 -->
                <section class="tab-pane" id="tab_3">
                    @foreach($fusers as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>
                            @include('IndexView.user.badges.like',['target_user'=>$user])
                        </div>
                    @endforeach
                </section>
            </div>
        </div>

    </section>

@endsection