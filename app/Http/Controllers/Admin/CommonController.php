<?php
/**
 * Created by PhpStorm.
 * User: yunxi
 * Date: 2019/3/19 0019
 * Time: 16:19
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Base\BaseController;
use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CommonController extends BaseController
{
    public $user_info;
    public $uid;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->checkLogin();
    }

    /**
     * Description 验证管理员是否登录
     */
    private function checkLogin(){
        // 验证是否登录
        $this->middleware(function ($request, $next) {
            //判断是否存在存储了用户信息的cookie
            if(Cookie::has('admin')){
                $admin_info = Admin::getOne(['id'=>Cookie::get('admin')],'*');
                Session::put('admin',$admin_info);
            }
            if(empty(session('admin'))){
                return redirect('/admin/login');
            }
            $this->user_info = session('admin');
            return $next($request);
        });
    }
}