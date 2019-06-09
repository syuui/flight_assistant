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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $sitename ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('generic.css') ?> 
    <?= $this->Html->script('jquery-3.2.1.min')?>
    <?= $this->Html->script('navi') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id='doc'>
        <!-- header -->
        <div id='header'>
            <div id='logo'><?= $this->Html->image('logo.png') ?></div>
            
            <!-- search box -->
            <?= $this->Element('search') ?>
            <!-- /search box -->
            
            <!-- navi -->
            <?=$this->Element('mainnavi')    ?>
            <!-- /navi -->
        </div>
        <!-- /header -->

        <!-- content -->
        <div id='content'>
        <?=$this->fetch('content')    ?>
        </div>
        <!-- /content -->

        <!-- footer -->
        <?=$this->Element('mainfooter')?>
        <!-- /footer -->
    </div>
</body>
</html>
