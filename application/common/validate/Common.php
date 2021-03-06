<?php
/**
 * Created by PhpStorm.
 * User: rehellinen
 * Date: 2017/9/30
 * Time: 12:25
 */

namespace app\common\validate;


class Common extends BaseValidate
{
    protected $rule = [
        ['id', 'require|number'],
        ['status', 'require|number'],
        ['page', 'require|number'],
        ['size', 'require|number'],
        ['ids', 'require'],
        ['type', 'require']
    ];

    protected $scene = [
        'id' => ['id'],
        'status' => ['status'],
        'page' => ['page', 'size'],
        'ids' => ['ids'],
        'type' => ['type']
    ];
}