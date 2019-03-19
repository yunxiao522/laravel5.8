<?php
/**
 * Created by PhpStorm.
 * User: yunxi
 * Date: 2019/3/18 0018
 * Time: 17:53
 */

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    private $cookit_ttl = 2678400;
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * @return false|string
     * Description 管理员登录方法
     */
    public function login(){
        $validator = Validator::make($this->request->all(),[
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'账号不能为空',
            'password.required'=>'请输入密码'

        ]);
        if($validator->fails()){
            return self::ajaxError($validator->errors()->first());
        }
        $email_rule =  '/^([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix';
        $phone_rule =  '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
        if(preg_match( $email_rule,$this->request->input('username'))){
            $where['email'] = $this->request->input('username');
        }elseif(preg_match( $phone_rule,$this->request->input('username'))){
            $where['phone'] = $this->request->input('username');
        }else{
            $where['name'] = $this->request->input('username');
        }
        $admin_info = Admin::getOne($where,'*');
        if(empty($admin_info)){
            return self::ajaxError('账号不存在');
        }
        if(!Hash::check($this->request->input('password'),$admin_info->password)){
            return self::ajaxError('账号密码不正确');
        }
        //处理cookie
        if($this->request->input('remember') == 'true'){
            Cookie::queue('admin',$admin_info->id,$this->cookit_ttl);
        }
        //处理session
        Session::put('admin',$admin_info);
        return self::ajaxOk('登录成功',$this->request->input('url'));
    }

    /**
     * Description 退出
     */
    public function logout(){
        Session::remove('admin');
        Cookie::queue('admin', null , -1); // 销毁
    }
}