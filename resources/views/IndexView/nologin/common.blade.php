<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="boystark">
    {{--csrf token 所有页面都不需要了--}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>laravel for blog</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="blog-masthead">
    <div class="container">
        <form action="/posts/search" method="GET">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a class="blog-nav-item " href="/">首页</a>
                </li>
                <li>
                    <a class="blog-nav-item" href="/login">写文章</a>
                </li>
                <li>
                    <a class="blog-nav-item" href="/login">通知</a>
                </li>

                <li>
                    <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
                </li>
                <li>
                    <button class="btn btn-default" style="margin-top:10px" type="submit">搜索</button>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <div>

                        <a href="/login" class="blog-nav-item dropdown-toggle"   >请登入</a>

                    </div>
                </li>
            </ul>
        </form>
    </div>
</header>
{{--空格--}}
<section class="blog-header"></section>

<article class="container">
    <div class="row">
        @yield("content")


        <section id="sidebar" class="col-md-4">
            <aside id="widget-welcome" class="widget panel panel-default">
                <div class="panel-heading">
                    欢迎！
                </div>
                <div class="panel-body">
                    <p>
                        欢迎来到简书网站
                    </p>
                    <p>
                        <strong><a href="/">简书网站</a></strong> 基于 Laravel5.4 构建
                    </p>
                    <div class="bdsharebuttonbox bdshare-button-style0-24" data-bd-bind="1494580268777"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a></div>
                    <script>window._bd_share_config={"common":{"bdSnsKey":{"tsina":"120473611"},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","renren","douban","weixin","qzone","tqq","bdhome"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                </div>
            </aside>

            <aside id="widget-categories" class="widget panel panel-default">
                <div class="panel-heading">
                    专题
                </div>

                <ul class="category-root list-group">
                    @foreach($topics as $topic)
                        <li class="list-group-item">
                            <a href="/login">{{$topic->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </section>
    </div>
</article>

@include("IndexView.layout.footer")
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/js/kangEditor.js"></script>
</body>
</html>