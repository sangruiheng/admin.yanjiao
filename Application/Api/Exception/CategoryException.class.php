<?php
/**
 * Created by 有情人好聚好散.
 * Author: ASang
 * Date: 18-8-8
 * Time: 下午10:17
 */

namespace Api\Exception;


class CategoryException extends BaseException
{
    public $code = 30000;

    public $msg = "分类不存在";

//    public $errorCode = 30000;
}