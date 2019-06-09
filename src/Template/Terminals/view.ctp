<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal $terminal
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('Edit Terminal'), ['action' => 'edit', $terminal->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Terminal'), ['action' => 'delete', $terminal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Terminals'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Terminal'), ['action' => 'add']) ?> </li>
		<hr>
		<li><?= $this->Html->link(__('List Airports'), ['controller' => 'Airports', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Airport'), ['controller' => 'Airports', 'action' => 'add']) ?> </li>
	</ul>
</nav>
<div class="terminals view large-9 medium-8 columns content">

	<h3><?=h($terminal->airport->name) . h($terminal->name) ?></h3>
	<table class="vertical-table">
		<tr>
			<th scope="row"><?= __('Id') ?></th>
			<td><?= $this->Number->format($terminal->id) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Airports') . __('Chinese Name') ?></th>
			<td><?= $terminal->has('airport') ? $this->Html->link($terminal->airport->name, ['controller' => 'Airports', 'action' => 'view', $terminal->airport->id]) : '' ?></td>
		</tr>
		<tr>
			<th scope="row"><?=__('Terminals') . __('Chinese Name') ?></th>
			<td><?= h($terminal->name) ?></td>
		</tr>
		<tr>
			<th scope="row"><?=__('Terminals') . __('Chinese Simple Name') ?></th>
			<td><?= h($terminal->sname) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Created') ?></th>
			<td><?= h($terminal->created) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Updated') ?></th>
			<td><?= h($terminal->updated) ?></td>
		</tr>
	</table>
</div>