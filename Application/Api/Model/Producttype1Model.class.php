<?php
namespace Api\Model;
use Think\Model\RelationModel;
class Producttype1Model extends RelationModel{
	protected $_link = array(
        'producttype1' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name' => 'productattr1',//要关联的表名
            'foreign_key' => 'attrtype_id', //本表的字段名称
//            'as_fields' => 'img:img',  //被关联表中的字段名：要变成的字段名
//            'relation_deep'    =>    'productValue',   //多表关联  关联第三个模型的名称
        ),
        'productarrt1' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name' => 'productattr1',//要关联的表名
            'foreign_key' => 'attrtype_id', //本表的字段名称
//            'as_fields' => 'img:img',  //被关联表中的字段名：要变成的字段名
//            'relation_deep'    =>    'productValue',   //多表关联  关联第三个模型的名称
        )
	);


}