<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('Edit Flight'), ['action' => 'edit', $flight->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Flight'), ['action' => 'delete', $flight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Flights'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Flight'), ['action' => 'add']) ?> </li>
		<hr>
		<li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?> </li>
		<hr>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?> </li>
		<hr>
		<li><?= $this->Html->link(__('List Terminals'), ['controller' => 'Terminals', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Terminal'), ['controller' => 'Terminals', 'action' => 'add']) ?> </li>
	</ul>
</nav>
<div class="flights view large-9 medium-8 columns content">
	<h3><?= h($flight->enterprise->iata . $flight->number) ?></h3>
	<table class="vertical-table">
		<tr>
			<th scope="row"><?= __('Id') ?></th>
			<td><?= $this->Number->format($flight->id) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Enterprises') ?></th>
			<td><?= $flight->has('enterprise') ? $this->Html->link($flight->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $flight->enterprise->id]) : '' ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Flight Number') ?></th>
			<td><?= h($flight->number) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Registers') ?></th>
			<td><?
if ($flight->has('register')) :
    echo $this->Html->link(h($flight->register->register), [
        'controller' => 'Registers',
        'action' => 'view',
        $flight->register->id
    ]) . 

    ' (' . $this->Html->link($flight->register->aircraft->type, [
        'controller' => 'Aircrafts',
        'action' => 'view',
        $flight->register->aircraft->id
    ]) . ')';

			endif
			?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Origin Terminal') ?></th>
			<td><?=$this->Html->link(h($flight->ori_terminal->airport->sname).h($flight->ori_terminal->sname), ['controller' => 'Terminals','action' => 'view',$flight->ori_terminal_id])?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Origin Datetime') ?></th>
			<td><?= h($flight->ori_datetime) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Gate') ?></th>
			<td><?= h($flight->gate) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Seat Number') ?></th>
			<td><?= h($flight->seat) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Destination Terminal')?></th>
			<td><?= $this->Html->link(h($flight->des_terminal->airport->sname).h($flight->des_terminal->sname), ['controller'=>'Terminals', 'action'=>'view', $flight->des_terminal_id]) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Destination Datetime') ?></th>
			<td><?= h($flight->des_datetime) ?></td>
		</tr>
	</table>
	<div class="row">
		<h4><?= __('Memo') ?></h4>
        <?= $this->Text->autoParagraph(h($flight->memo)); ?>
    </div>
</div>
