<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/static/admin/js/jquery.js"></script>
    <title>文章添加</title>
</head>
<body>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{url('/article/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    文章标题: <input type="text" name="title" id="title"><br>
    文章分类: <select name="type_id" id="type_id">
                    <option value="">--请选择--</option>
                    @foreach($typeInfo as $v)
                    <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                    @endforeach
              </select><br>
    文章重要性: <input type="radio" name="important" value="1" class="important" checked>普通
                <input type="radio" name="important" value="2" class="important">置顶<br>
    是否显示: <input type="radio" name="display" value="1" class="display" checked>显示
              <input type="radio" name="display" value="2" class="display"> 不显示 <br>
    文章作者: <input type="text" name="author" ><br>
    作者emali: <input type="text" name="email"><br>
    关键字: <input type="text" name="Keyword"><br>
    网页描述: <textarea name="desc" id="" cols="30" rows="10"></textarea><br>
    文件上传: <input type="file" name="upload"><br>
                <button>提交</button>
</form>
</body>
</html>
<script>
    $("#title").blur(function(){
//        alert(1);
        var title = $(this).val();
        var reg = /^[\u4e00-\u9fa5\w]{2,30}$/
        if(!reg.test(title)){
            alert('文章标题是中文数字字母下划线');
            retrun;
        }
        flag = true;
        $.ajax({
            method:"post",
            url:"{{url('/article/checkOnly')}}",
            data:{title:title,_token:'{{csrf_token()}}'}
        }).done(function(msg){
            if( msg>0){
               alert('标题已存在');
               flag = false;
            }
        })
        if(flag=false){
            return;
        }
        $('form').submit();
    })

</script>