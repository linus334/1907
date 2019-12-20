<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>品牌添加</title>
</head>
<body>
<form action="{{'/goods/store'}}" method="post" enctype="multipart/form-data">
    @csrf
    商品名称: <input type="text" name="goods_name"><br>
    商品价格: <input type="text" name="goods_price"><br>
    商品库存: <input type="text" name="goods_num"><br>
    商品图片: <input type="file" name="goods_img"><br>
    商品相册: <input type="file" name="goods_imgs"><br>
    商品详情: <textarea name="goods_desc" id="" cols="30" rows="10"></textarea><br>
        新品: <input type="radio" name="is_new" value="1">是
              <input type="radio" name="is_new" value="2">否 <br>
        精品: <input type="radio" name="is_best" value="1">是
              <input type="radio" name="is_best" value="2">否<br>
        热卖: <input type="radio" name="is_hot" value="1">是
              <input type="radio" name="is_hot" value="2">否<br>
        上架: <input type="radio" name="is_up" value="1">是
              <input type="radio" name="is_up" value="2">否<br>
        品牌: <select name="brand_id" id="">
                     @foreach($brandInfo as $v)
                     <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                     @endforeach
              </select><br>
        分类: <select name="cate_id" id="">
                    <option value="">--请选择--</option>
                        @foreach ($info as $v)
                            <option value="{{$v->cate_id}}">{{str_repeat('-',$v->level)}}{{$v->cate_name}}</option>
                        @endforeach
             </select> <br>
            <button>提交</button>
</form>
</body>
</html>