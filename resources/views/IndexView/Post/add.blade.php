@extends("IndexView.layout.main")

@section("content")
    <section class="col-md-8 blog-main">
        <form action="/posts" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <input type="hidden" id="content" name="content" value="">
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