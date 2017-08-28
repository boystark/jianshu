@extends("IndexView.layout.main")

@section("content")
    <section class="col-md-8 blog-main">
        <form action="/posts/{{$post->id}}" method="POST">
            {{--<input type="hidden" name="_method" value="PUT">--}}
           {{method_field("PUT")}}
            {{csrf_field()}}
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
            </div>
            <input type="hidden" id="content" name="content" value="{{$post->content}}">
            <div class="form-group">
                <label>内容</label>
                <div id="editor" >
                </div>
            </div>
            @include('IndexView.layout.postError')
            <button type="submit" class="btn btn-default" id="btn-submit">提交</button>
        </form>
        <br>
    </section>
@endsection