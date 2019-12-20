@extends('layouts.show')
@section('title', '收货地址')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="login.html" method="get" class="reg-login" id="myform">
         @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="detail" placeholder="详细地址" /></div>

        <select class="area" name="province">
         <option value="" selected="selected">请选择...</option>
         @foreach($provinceInfo as $k=>$v)
         <option value="{{$v->id}}">{{$v->name}}</option>
          @endforeach
        </select>


        <select class="area" name="city">
         <option value="" selected="selected">请选择...</option>
        </select>


        <select class="area" name="area">
         <option value="" selected="selected">请选择...</option>
        </select>

       <div class="lrList"><input type="text" name="tel" placeholder="手机" /></div>
       <tr>
           <td  colspan="5">
           <input type="checkbox" name="is_default" value="1"/>设为默认
           </td>
          </tr>
      </div><!--lrBox/-->
      <div class="lrSub">
          <p align="right">
              <a href="#"  class="add_b">添加</a>
          </p>
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
     <script src="/static/admin/js/jquery.js"></script>
     <script>

             //给下拉菜单绑定内容改变事件
             $(document).on('change',".area",function(){

                 var _this=$(this);
                 _this.nextAll("select").html("<option value=''>--请选择--</option>")
                 var id=_this.val();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.post(

                     "{{url('/getArea')}}",
                     {id:id},
                     function(res){
                         var _option="<option value=''>--请选择--</option>";
                         for(var i in res){
                             _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>"
                         }
                         _this.next("select").html(_option);
                     },
                     'json'
                 )
             })
             $(document).on('click','.add_b',function(){
                 //获取表单中所有的值
                 var data=$("#myform").serialize();

                 $.post(
                     "{{url('/save')}}",
                     data,
                     function(res){
                         if(res.code==1){
                             alert('添加成功');
                             location.href="{url('/address')}";
                         }else{
                             alert('添加失败');
                             location.href="{url('/index')}";
                         }
                     },
                     'json'
                 )
             })

     </script>
@endsection


