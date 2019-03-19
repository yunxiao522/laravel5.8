<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function ajaxOk($msg = '', $url = '', $code = 0)
    {
        $data = [
            'msg' => $msg,
            'url' => $url,
            'success' => true,
            'code' => $code
        ];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public static function ajaxError($msg = '', $url = '', $code = 1)
    {
        $data = [
            'msg' => $msg,
            'url' => $url,
            'success' => false,
            'code' => $code,
        ];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public static function ajaxOkData($data = [], $msg = '', $url = '', $code = 0)
    {
        $a = [
            'msg' => $msg,
            'url' => $url,
            'success' => true,
            'code' => $code,
            'data' => $data
        ];
        return json_encode($a, JSON_UNESCAPED_UNICODE);
    }

    public static function ajaxErrotData($data = [], $msg = '', $url = '', $code = 1)
    {
        $a = [
            'msg' => $msg,
            'url' => $url,
            'success' => false,
            'code' => $code,
            'data' => $data
        ];
        return json_encode($a, JSON_UNESCAPED_UNICODE);
    }
}
