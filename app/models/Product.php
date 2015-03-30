<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends BaseModel
{
    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'product';


    public function varietie()
    {
        return $this->belongsTo('Varietie', 'varietieId');
    }

    public function date_to_age($strTime){
        return date_to_age(time()-strtotime($strTime));
    }

    public function age_to_date($ageY,$ageM,$ageD, $format = 'Y-m-d'){
        $diff = (intval($ageY) * 31536000 ) + (intval($ageM) * 2592000) + (intval($ageD) * 86400);
        if( $diff <= 0){
            return false;
        }

        $timestamp = time()-$diff;
        if(!is_null($format)){
            return date($format,$timestamp);
        }
        return $timestamp;
    }
}
