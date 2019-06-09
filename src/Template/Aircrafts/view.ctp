<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aircraft $aircraft
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('Edit Aircraft'), ['action' => 'edit', $aircraft->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Aircraft'), ['action' => 'delete', $aircraft->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aircraft->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Aircraft'), ['action' => 'add']) ?> </li>
	</ul>
</nav>
<div class="aircrafts view large-9 medium-8 columns content">
	<h3><?= h($aircraft->type) ?></h3>
	<table class="vertical-table">
		<tr>
			<th scope="row"><?= __('Id') ?></th>
			<td><?= $this->Number->format($aircraft->id) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('aircraft type') ?></th>
			<td><?= h($aircraft->type) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('maker') ?></th>
			<td><?= h($aircraft->maker) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Created') ?></th>
			<td><?= h($aircraft->created) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Updated') ?></th>
			<td><?= h($aircraft->updated) ?></td>
		</tr>
	</table>
</div>
