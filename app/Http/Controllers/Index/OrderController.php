<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Goods;
class OrderController extends Controller
{
//    public function index(){
//        $cartInfo = Cart::all();
//        return view('index.order.pay',['cartInfo'=>$cartInfo]);
//    }
    //结算
    public function index(){
        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        if(empty($goods_id)){
            echo '请至少选择一件商品';die;
        }
        $info = session('user');
        $id = $info['id'];
        if(empty($id)){
            echo '请先登陆';
            return redirect('/login');
        }
        $where = [
            ['id','=',$id]
        ];
        $cartInfo = Cart::join('goods','goods.goods_id','=','cart.goods_id')->where($where)->whereIn('cart.goods_id',$goods_id)->get();
        $total = 0;
        foreach ($cartInfo as $v){
            $total += $v['goods_price']*$v['buy_number'];
        }
        return view('index.order.pay',['cartInfo'=>$cartInfo,'total'=>$total]);
    }
}
