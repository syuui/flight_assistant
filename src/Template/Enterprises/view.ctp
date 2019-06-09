<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('Edit Enterprise'), ['action' => 'edit', $enterprise->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Enterprise'), ['action' => 'delete', $enterprise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enterprise->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Enterprises'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Enterprise'), ['action' => 'add']) ?> </li>
	</ul>
</nav>
<div class="enterprises view large-9 medium-8 columns content">
	<h3><?= h($enterprise->name) ?></h3>
	<table class="vertical-table">
		<tr>
			<th scope="row"><?= __('Id') ?></th>
			<td><?= $this->Number->format($enterprise->id) ?></td>
		</tr>

		<tr>
			<th scope="row"><?= __('Chinese Name') ?></th>
			<td><?= h($enterprise->name) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Chinese Simple Name') ?></th>
			<td><?= h($enterprise->sname) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('English Name') ?></th>
			<td><?= h($enterprise->ename) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('IATA Code') ?></th>
			<td><?= h($enterprise->iata) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('ICAO Code') ?></th>
			<td><?= h($enterprise->icao) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Website') ?></th>
			<td><?= h($enterprise->url) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Created') ?></th>
			<td><?= h($enterprise->created) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Updated') ?></th>
			<td><?= h($enterprise->updated) ?></td>
		</tr>
	</table>
</div>
