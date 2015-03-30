<?php
/**
 * Created by PhpStorm.
 * User: admin-chen
 * Date: 14-5-23
 * Time: 下午5:10
 * ajax分页实例
 */

/**
 * 处理了分页数过多的问题
 */
/*$page_func = $paginator->ajax_paginate_func_name;
$curr_page = $paginator->getCurrentPage();
$last_page = $paginator->getLastPage();
$totalArr  = range(1, $last_page);

if ($last_page <= 1)
    return;
if ($curr_page == 1) {
    $backHtml = '<li class="disabled"><span>«</span></li>';
} else {
    $backHtml = '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . ($curr_page - 1) . ')"><span>«</span></a></li>';
}
if ($curr_page == $last_page) {
    $goHtml = '<li class="disabled"><span>»</span></li>';
} else {
    $goHtml = '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . ($curr_page + 1) . ')"><span>»</span></a></li>';
}
$pageHtml = '<ul class="pagination pull-right">' . $backHtml;
foreach ($totalArr as $k => $v) {
    if ($v == $curr_page) {
        $pageHtml .= '<li class="active"><a href="javascript:void(0)">' . $v . '</a></li>';
    } else {
        $pageHtml .= '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . $v . ')">' . $v . '</a></li>';
    }
}
$pageHtml .= $goHtml . '</ul>';
echo $pageHtml;*/

/**
 * 处理了分页数过多的问题
 *
 */
$page_func = $paginator->ajax_paginate_func_name;
$curr_page = $paginator->getCurrentPage();
$last_page = $paginator->getLastPage();

//页码范围计算
$init = 1;//起始页码数
$max = $last_page;//结束页码数
$pagelen = 7;//要显示的页码个数
$pagelen = ($pagelen%2) ? $pagelen : $pagelen+1;//页码个数
$pageoffset = ($pagelen-1)/2;//页码个数左右偏移量
//分页数大于页码个数时可以偏移
if($last_page>$pagelen){
    //如果当前页小于等于左偏移
    if($curr_page<=$pageoffset){
        $init=1;
        $max = $pagelen;
    }else{//如果当前页大于左偏移
        //如果当前页码右偏移超出最大分页数
        if($curr_page+$pageoffset>=$last_page+1){
            $init = $last_page-$pagelen+1;
        }else{
            //左右偏移都存在时的计算
            $init = $curr_page-$pageoffset;
            $max = $curr_page+$pageoffset;
        }
    }
}
$totalArr  = range($init, $max);

if ($last_page <= 1)
    return;
if ($curr_page == 1) {
    $backHtml = '<li class="disabled"><span>«</span></li>';
} else {
    $backHtml = '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . ($curr_page - 1) . ')"><span>«</span></a></li>';
}
if ($curr_page == $last_page) {
    $goHtml = '<li class="disabled"><span>»</span></li>';
} else {
    $goHtml = '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . ($curr_page + 1) . ')"><span>»</span></a></li>';
}
$pageHtml = '<ul class="pagination pull-right">' . $backHtml;
foreach ($totalArr as $k => $v) {
    if ($v == $curr_page) {
        $pageHtml .= '<li class="active"><a href="javascript:void(0)">' . $v . '</a></li>';
    } else {
        $pageHtml .= '<li><a href="javascript:void(0);" onclick="' . $page_func . '(' . $v . ')">' . $v . '</a></li>';
    }
}
$pageHtml .= $goHtml . '</ul>';
echo $pageHtml;
?>