<?php
/**
 * Created by PhpStorm.
 * User: yunxi
 * Date: 2019/3/19 0019
 * Time: 16:05
 */

namespace App\Model;


class Admin extends Base
{
    public $table = 'admin';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}