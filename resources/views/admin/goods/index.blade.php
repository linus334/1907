<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>商品id</td>
            <td>商品名称</td>
            <td>商品价格</td>
            <td>商品库存</td>
            <td>商品图片</td>
            <td>商品相册</td>
            <td>商品详情</td>
            <td>新品</td>
            <td>精品</td>
            <td>热卖</td>
            <td>上架</td>
            <td>品牌</td>
            <td>分类</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_num}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" height="100"></td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_imgs}}" height="100"></td>
            <td>{{$v->goods_desc}}</td>
            <td>{{$v->is_new==1?'√':'×'}}</td>
            <td>{{$v->is_best==1?'√':'×'}}</td>
            <td>{{$v->is_hot==1?'√':'×'}}</td>
            <td>{{$v->is_up==1?'√':'×'}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
            <td>
                <a href="{{url('/goods/delete'.$v->goods_id)}}">删除</a>
                <a href="">编辑</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->links()}}
</body>
</html>