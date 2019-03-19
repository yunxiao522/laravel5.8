<?php

namespace App\model;

use App\Flight;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public $table;
    public $primaryKey = 'id';
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function getOne($where,$field = '*'){
        return self::where($where)->first($field);
    }

    public static function edit($where,$data){
        return self::where($where)->update($data);
    }
}
