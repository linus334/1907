@extends('layouts.show')
@section('title', '珠宝店--购物车')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="li25%" agn="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="allBox"/> 全选</a></td>

       </tr>
          @foreach($data as $v)
       <tr goods_id="{{$v->goods_id}}">
        <td width="4%">
            <input type="checkbox" name="1" class="box" />
        </td>
        <td class="dingimg" width="15%">
            <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" />
        </td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{$v->add_time}}</time>
        </td>
        <td align="right">
            <div class="c_num" goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}" >
                <input type="button" value="+" class="car_btn_1 add" />
                <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number"/>
                <input type="button" value="-" class="car_btn_2 less" />
            </div>
            <a href="javascript:;" class="del">删除</a>
        </td>
              <tr>
                  <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
              </tr>
       </tr>


          @endforeach

      </table>
         <tr><a href="javascript:;" class="delMany">删除选中的商品</a></tr>
     </div><!--dingdanlist/-->

     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
     @endsection
<script src="/static/admin/js/jquery.js"></script>
<script>
    //加号 +
    $(document).on("click",".add",function(){
        var _this = $(this);
        var goods_id = _this.parent('div').attr('goods_id');//获取当前商品的id
        var goods_num = parseInt(_this.parent('div').attr('goods_num'));
        var buy_number = parseInt(_this.next('input').val());
        if(buy_number>=goods_num){
            _this.next('input').val(goods_num)
        }else{
            buy_number = buy_number+1
            _this.next('input').val(buy_number)
        }
        //2、数据库中的购买数量为文本框的值
        changeNum(goods_id,buy_number);
        //4、获取小计
        getTotal(goods_id,_this);
        //5、从新获取总价
//        getCount();
    })
    $(document).on('click','.less',function(){
        var _this = $(this);
        var goods_id = _this.parent('div').attr('goods_id');//获取当前商品的id
        var buy_number = parseInt(_this.prev('input').val());
        if(buy_number<=1){
            _this.prev('input').val(1)
        }else{
            buy_number = buy_number-1
            _this.prev('input').val(buy_number)
        }
        //2、数据库中的购买数量为文本框的值
        changeNum(goods_id,buy_number);
        //4、获取小计
        getTotal(goods_id,_this);
        //5、从新获取总价
        getCount();

    })
    //失去焦点
    $(document).on('blur','.buy_number',function() {
        var _this = $(this);//当前失去焦点的对象 文本框
        var goods_id = _this.parent('div').attr('goods_id');//获取当前商品的id
        var buy_number = _this.val();//获取文本框的值
        var goods_num = parseInt(_this.parent('div').attr('goods_num'));//获取当前商品的库存

        //1、检测购买数量
        var reg = /^\d+$/;
        if (!reg.test(buy_number) || parseInt(buy_number) <= 0) {
            _this.val(1);
        } else if (parseInt(buy_number) >= parseInt(goods_num)) {
            _this.val(goods_num);
        } else {
            buy_number = parseInt(buy_number);
            _this.val(buy_number);
        }
        //2、数据库中的购买数量为文本框的值
        changeNum(goods_id,buy_number);
        //4、获取小计
        getTotal(goods_id,_this);
        //5、从新获取总价
        getCount();
    })
    //点击复选框
    $(document).on('click','.box',function(){
        var status = $(this).prop('checked');
        getCount();
    })

    //点击全选
    $(document).on('click','#allBox',function(){
        var status = $("#allBox").prop('checked');//获取第一个复选框的状态
        $(".box").prop('checked',status);//所有复选框和第一个保持一致
        getCount();
    })
    //改变购买数量
    function changeNum(goods_id,buy_number){
        $.ajax({
            url:"{{url('/ChangeNum')}}",
            type:'post',
            data:{buy_number:buy_number,goods_id:goods_id,_token:"{{csrf_token()}}"},
            async:false,
            dataType:'json'
        }).done(function(res){
            if(res.code==2){
                alert(res.font);
            }
        })
    }
    //获取小计
    function getTotal(goods_id,_this){
        $.ajax({
            url:"{{url('/getTotal')}}",
            type:'post',
            data:{goods_id:goods_id,_token:"{{csrf_token()}}"},
            async:false,
            dataType:'json'
        }).done(function(res){
            if(res){
                _this.parents('tr').next('tr').find('th').find('strong').text("￥"+res);
            }
        })
    }
    //总价
    function getCount(){
        var _box = $(".box:checked")
        var goods_id = "";
        _box.each(function(index){
            goods_id += $(this).parents('tr').attr('goods_id')+',';

        })
        goods_id = goods_id.substr(0,goods_id.length-1);
        //求总价
        $.get(
            "{{url('getCount')}}",
            {goods_id:goods_id},
            function(res){
//               console.log(res)
                $("#money").text('￥'+res);
            }
        );
    }
    //点击删除
    $(document).on('click','.del',function(){
        var _this = $(this);
        var goods_id = _this.parents('tr').attr('goods_id');
        $.get(
            "{{url('cart/delete')}}",
            {goods_id:goods_id},
            function(res){
                if(res.code==2){
                    alert(res.font)
                }else{
                    _this.parents('tr').next('tr').hide();
                    _this.parents('tr').remove();
                    getCount();
                }
            }
        )
    })
    //批量删除
    $(document).on('click','.delMany',function(){
        var _this=$(this);
        var _box = $(".box:checked")
        if(_box.length<=0){
            alert('请至少选择一种商品');
            return false;
        }
        var goods_id = "";
        _box.each(function(index){
            goods_id += $(this).parents('tr').attr('goods_id')+',';
        })
        goods_id = goods_id.substr(0,goods_id.length-1);
        $.get(
            "{{url('cart/delete')}}",
            {goods_id:goods_id},
            function(res){
                if(res){
                    //_this.parents('tr').next('tr').remove();
                    _this.parent('tr') .remove();
                }else{
                    alert(res.font)
                }
            }
        )
    })
    //点击确认结算
    $(document).on('click','.jiesuan',function(){
        var _box = $(".box:checked")
        var goods_id = "";
        _box.each(function(index){
            goods_id += $(this).parents('tr').attr('goods_id')+',';
        })
        goods_id = goods_id.substr(0,goods_id.length-1);
        if(goods_id==''){
            alert('至少选择一件商品');
        }else{
            location.href = "{{url('/jiesuan')}}?goods_id="+goods_id;
        }
    })
</script>