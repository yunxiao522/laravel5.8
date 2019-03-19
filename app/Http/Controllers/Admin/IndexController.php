<?php
/**
 * Created by PhpStorm.
 * User: yunxi
 * Date: 2019/3/19 0019
 * Time: 17:10
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class IndexController extends CommonController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(){

    }
}