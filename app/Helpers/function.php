<?php
/**
 * 公共
 */
function getAll(){
    echo 1223;
}
function postCateInfo($cateInfo,$parent_id=0,$level=1){
    static $info = [];
    foreach($cateInfo as $k=>$v){
        if($v['parent_id']==$parent_id){
            $v['level']=$level;
            $info[]=$v;
            postCateInfo($cateInfo,$v['cate_id'],$level+1);
        }
    }
    return $info;
}
