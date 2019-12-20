@extends('layouts.show')
@section('title', '珠宝店--注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/do_reg')}}" method="post" class="reg-login">
         @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" placeholder="输入手机号码或者邮箱号" name="email" id="email"/></div>
       <div class="lrList2">
           <input type="text" placeholder="输入短信验证码" name="code" id="code"/>
           <a href="javasprice:;" id="click">获取验证码</a>
       </div>
       <div class="lrList"><input type="text" placeholder="设置新密码（6-18位数字或字母）" name="pwd"/></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码" name="pwds"/></div>
      </div><!--lrBox/-->
      <div >
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->

@endsection
<script src="/static/admin/js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','#click',function(){
            var email = $("#email").val();
            $.ajax({
                url:"{{url('/send')}}",
                data:{email:email,_token:'{{csrf_token()}}'},
                type:'POST',
            }).done(function(res){
                if(!res){
                    alert(发送成功);
                }
            })
        })
    })
</script>