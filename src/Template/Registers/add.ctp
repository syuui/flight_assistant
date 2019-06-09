<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Register $register
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Registers'), ['action' => 'index']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="registers form large-9 medium-8 columns content">
    <?= $this->Form->create($register) ?>
    <fieldset>
		<legend><?= __('New Register') ?></legend>
        <?php
        echo $this->Form->control('register', [
            'label' => __('Registers')
        ]);
        echo $this->Form->control('enterprise_id', [
            'options' => $enterprises,
            'label' => __('Chinese Name')
        ]);
        echo $this->Form->control('aircraft_id', [
            'options' => $aircrafts,
            'label' => __('type')
        ]);
        echo $this->Form->control('memo', [
            'label' => __('Memory')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
