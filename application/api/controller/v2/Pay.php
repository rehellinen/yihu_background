<?php
/**
 * Created by PhpStorm.
 * User: rehellinen
 * Date: 2018/3/31
 * Time: 14:14
 */

namespace app\api\controller\v2;

use app\common\exception\SuccessMessage;
use app\common\service\WxNotify;
use app\common\service\Pay as PayService;
use app\common\validate\Order;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkBuyerSellerShopScope' => ['only' => 'getPreOrder']
    ];

    /**
     * 获取预订单
     * @param string $order_identify 预订单标识（纯数字代表订单ID，字符串标识订单NO）
     * @throws SuccessMessage
     */
    public function getPreOrder($order_identify = '')
    {
        (new Order())->goCheck('pay');
        $pay = new PayService($order_identify);
        $res = $pay->pay();
        throw new SuccessMessage([
            'message' => '获取微信支付预订单参数成功',
            'data' => $res
        ]);
    }

    /**
     * 接收微信支付的回调
     */
    public function receiveNotify()
    {
        $notify = (new WxNotify());
        $notify->Handle();
    }
}