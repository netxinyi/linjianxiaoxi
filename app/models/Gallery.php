<?php

class Gallery extends BaseModel {
    /**
     * 软删除
     * @var boolean
     */
    protected $softDelete = false;

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'gallery';

    protected $primaryKey = 'id';
    public function varietie()
    {
        return $this->belongsTo('Varietie', 'varietieId');
    }

    public function createProductImg(array $input, $productId){
        $imgs = array();
        if(is_array($input)){
            foreach($input as $key=>$img){
                $img['productId'] = $productId;
                $imgs[] = $img;
            }
           return DB::table($this->table)->insert($imgs);
        }
        return false;
    }
    public function inputImgForSave(array $input , $productId){
        $imgs = array();
        if(is_array($input)){
            foreach($input as $key=>$img){
                $img['productId'] = $productId;
                $imgs[] = $img;
            }
            return $imgs;
        }
        throw new Exception('异常错误');
    }

}