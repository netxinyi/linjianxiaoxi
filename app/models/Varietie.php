<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Varietie extends BaseModel
{
    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = true;

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'varietie';



}
