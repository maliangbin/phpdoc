<?php
/**
 * @package: workspace
 * @description: test.php
 * @author: maliangbin Email:maliangbin@hoge.cn
 * @link: http://www.hoge.cn
 * @version: 1.0
 * @date: 18/4/28
 */
require "./vendor/autoload.php";

$file = 'zijinshan.docx';
$path = './images';
$docObj = \phpdoc\Factory::load($file);
$response = $docObj->saveImages($path);