$(document).ready(function(){
    var is_have_editor = document.getElementById('editor');
    if(is_have_editor){
        var E = window.wangEditor;
        var editor = new E('#editor');
//自定义菜单
        editor.customConfig.menus = [
            'head',  // 标题
            'bold',  // 粗体
            'italic',  // 斜体
            'underline',  // 下划线
            'strikeThrough',  // 删除线
            'foreColor',  // 文字颜色
            'backColor',  // 背景颜色
            'link',  // 插入链接
            'list',  // 列表
            'justify',  // 对齐方式
            'quote',  // 引用
            // 'emoticon',  // 表情
            'image',  // 插入图片
            'table',  // 表格
            // 'video',  // 插入视频
             'code',  // 插入代码
            'undo',  // 撤销
            'redo'  // 重复
        ];
// 使用 base64 保存图片
//editor.customConfig.uploadImgShowBase64 = true;

//设置headers
        editor.customConfig.uploadImgHeaders = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };
// 将 timeout 时间改为 3s
        editor.customConfig.uploadImgTimeout = 5000;
// 将图片大小限制为 3M
        editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024;
// 限制一次最多上传 5 张图片
        editor.customConfig.uploadImgMaxLength = 5;
//跨域上传中如果需要传递 cookie 需设置 withCredentials
        editor.customConfig.withCredentials = true;
//自定义图片名称
        editor.customConfig.uploadFileName = 'kangEditorFile';
        editor.customConfig.uploadImgServer = '/post/image/upload';

        editor.customConfig.customAlert = function (info) {
            alert('杨康提示您：' + info)
        };

// editor.customConfig.customUploadImg = function (files, insert) {
//     // files 是 input 中选中的文件列表
//     // insert 是获取图片 url 后，插入到编辑器的方法
//
//     // 上传代码返回结果之后，将图片插入到编辑器中
//     //insert(imgUrl)
//     alert(imgUrl);
// };
        editor.customConfig.uploadImgHooks = {
            before: function (xhr, editor, files) {
                // 图片上传之前触发
                // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

                // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
                // return {
                //     prevent: true,
                //     msg: '放弃上传'
                // }
                //alert('图片上传之前触发');
            },
            success: function (xhr, editor, result) {
                // 图片上传并返回结果，图片插入成功之后触发
                // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
                //alert('图片上传并返回结果，图片插入成功之后触发');
            },
            fail: function (xhr, editor, result) {
                // 图片上传并返回结果，但图片插入错误时触发
                // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
                alert('图片插入错误');
            },
            error: function (xhr, editor) {
                // 图片上传出错时触发
                // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
                alert('上传图片发生错误');
            },
            timeout: function (xhr, editor) {
                // 图片上传超时时触发
                // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
                alert('上传图片超时');
            },

            // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
            // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
            customInsert: function (insertImg, result, editor) {
                // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
                // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

                // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
                var url = result.url;
                insertImg(url);
                // result 必须是一个 JSON 格式字符串！！！否则报错
            }
        };

// 或者 var editor = new E( document.getElementById('#editor') )
        editor.create();


        editor.txt.html(document.getElementById('content').value);
        document.getElementById('btn-submit').addEventListener('click', function () {
            document.getElementById('content').value=editor.txt.html();
        }, false);
    }else{
        //ajax
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".like-button").click(function (event) {
            var target = $(event.target);
            var current_like = target.attr('like-value');
            var user_id = target.attr('like-user');
            if(current_like == 1){
                //取消关注
                $.ajax({
                    url:"/user/"+user_id+"/unfan",
                    method:'POST',
                    dataType:'json',
                    success:function (data) {
                        if(data.error != 0){
                            alert(data.msg);
                            return;
                        }
                        target.attr('like-value',0);
                        target.text("关注");
                    }
                })
            }else{
                //关注
                $.ajax({
                    url:"/user/"+user_id+"/fan",
                    method:'POST',
                    dataType:'json',
                    success:function (data) {
                        if(data.error != 0){
                            alert(data.msg);
                            return;
                        }
                        target.attr('like-value',1);
                        target.text("取消关注");
                    }
                })
            }
        });
    }
});



