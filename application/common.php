<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//定义统一返回格式
function show($status, $message, $data = array())
{
    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $data
    );
    return json($return);
}

function curl_http($url, $type = 0, $data = "", &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    // 处理POST的情况
    if ($type == 1) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    $content = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $content;
}

function getRandChars($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $max = strlen($strPol) - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

function getOrderStatus($value)
{
    switch ($value)
    {
        case \enum\OrderEnum::UNPAID:
            return '未付款';
            break;
        case \enum\OrderEnum::PAID:
            return '待发货';
            break;
        case \enum\OrderEnum::DELIVERED:
            return '已发货';
            break;
        case \enum\OrderEnum::COMPLETED:
            return '已完成';
            break;
        case \enum\OrderEnum::PAID_BUT_NO_GOODS:
            return '已付款但是库存不足';
            break;
        case \enum\OrderEnum::WITHDRAWING:
            return '提现中';
            break;
        case \enum\OrderEnum::WITHDRAWN:
            return '提现完成';
            break;
        default:
            return '未知状态';
    }
}

function getStatus($value)
{
    switch ($value)
    {
        case \enum\StatusEnum::DELETED:
            return '已删除';
            break;
        case \enum\StatusEnum::NORMAL:
            return '审核通过';
            break;
        case \enum\StatusEnum::NOTPASS:
            return '待审核';
            break;
        default:
            return '未知状态';
    }
}

function generateNumber($length, $num = 6)
{
    $numbers = range(0, $length - 1);
    shuffle($numbers);
    return array_slice($numbers, 0, $num);
}
