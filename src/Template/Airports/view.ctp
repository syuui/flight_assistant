<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport $airport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('Edit Airport'), ['action' => 'edit', $airport->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Airport'), ['action' => 'delete', $airport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Airports'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Airport'), ['action' => 'add']) ?> </li>
	</ul>
</nav>
<div class="airports view large-9 medium-8 columns content">
	<h3><?= h($airport->name) ?></h3>
	<table class="vertical-table">
		<tr>
			<th scope="row"><?= __('Id') ?></th>
			<td><?= $this->Number->format($airport->id) ?></td>
		</tr>

		<tr>
			<th scope="row"><?= __('Chinese Name') ?></th>
			<td><?= h($airport->name) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Chinese Simple Name') ?></th>
			<td><?= h($airport->sname) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('English Name') ?></th>
			<td><?= h($airport->ename) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('IATA Code') ?></th>
			<td><?= h($airport->IATA) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('ICAO Code') ?></th>
			<td><?= h($airport->ICAO) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Created') ?></th>
			<td><?= h($airport->created) ?></td>
		</tr>
		<tr>
			<th scope="row"><?= __('Updated') ?></th>
			<td><?= h($airport->updated) ?></td>
		</tr>
	</table>
</div>
