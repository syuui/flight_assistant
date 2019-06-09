<?php
/**
 * 首页
 * 
 * @copyright 2019 <a href="mailto:syuui@syuui.site">syuui</a>, all rights reserved. 
 * @version 1.0.0
 *  
 * 
 */
use Cake\Core\Configure;
$sitename = Configure::read('cf.sitename');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport"
	content="width=device-width, initial-scale=1.0">
<title><?= $sitename ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('top.css') ?>
    <?= $this->Html->script('jquery-3.2.1.min')?>
    <?= $this->Html->script('navi') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<div id="top-pic">
    <?= $this->Html->link('进入网站', ['controller'=>'top','action'=>'index'])?>
    <?php
    $debug_flg = getenv('CAKEPHP_DEBUG');
    pr('<h1 style="padding-top: 100px;color:red;">现在为开发模式,Apache的CAKEPHP_DEBUG环境变量值为' . $debug_flg . ' !</h1>');
    ?>
	</div>

</body>
</html>