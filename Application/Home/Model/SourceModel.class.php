<?php
namespace Home\Model;
use Think\Model;
/**
 * Description of SourceModel
 * 来源模型
 * @author 叶天跃
 * @datetime 2016-9-7 15:57:50
 */
class SourceModel extends Model{
    //自动验证
    protected $_validate=array(
        array('sname','require','来源名称不能为空!'),
        array('sname','','来源名称已经存在!',0,'unique',1),
    );
    protected $_auto=array(
        array('ctime','time',1,'function'),
    ); 
}
