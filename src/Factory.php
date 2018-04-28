<?php
/**
 * @package: workspace
 * @description: Factory.php
 * @author: maliangbin Email:maliangbin@hoge.cn
 * @link: http://www.hoge.cn
 * @version: 1.0
 * @date: 18/4/27
 */
namespace phpdoc;

use phpdoc\src\DocInterface;
use phpdoc\src\Word2007;
class Factory{
    public static function load($file,$name='Word2007'){
        $class = "phpdoc\\src\\".$name;
        if(class_exists($class)){
            $classObj = new $class;
            $classObj->load($file);
            return $classObj;
        }else{
            throw new \Exception("\"{$name}\" is not a valid .");
        }
    }
}