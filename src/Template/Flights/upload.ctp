<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight[]|\Cake\Collection\CollectionInterface $flights
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Flight'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Flights'), ['action'=>'index'])?></li>
		<hr>
		<li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Terminals'), ['controller' => 'Terminals', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Terminal'), ['controller' => 'Terminals', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="flights index large-9 medium-8 columns content">
	<h3><?= __('Flights Upload') ?></h3>
	<span class="message">
	航班信息数据文件格式应为逗号分隔CSV，字符型字段不需要双引号。<br>
	字段格式为： [航空公司（简称）],[航班号],[机型],[出发航站楼],[出发时间（YYYY-MM-DD HH:II:SS）],[登机口],[到达航站楼],[到达时间（YYYY-MM-DD HH:II:SS）],[座位号],[备注]	
	</span>

	
	<?php
echo $this->Form->create($fuForm, [
    'type' => 'file',
    'accept-charset'=>'utf-8'
]);
echo $this->Form->control('uploadFile', [
    'label' => __('Upload File'),
    'type' => 'file'
]);

echo $this->Form->button(__('Submit'));

echo $this->Form->end();
?>

</div>
