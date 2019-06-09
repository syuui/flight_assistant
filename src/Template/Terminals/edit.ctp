<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal $terminal
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?=$this->Form->postLink(__('Delete'), ['action' => 'delete',$terminal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->id)])?></li>
		<li><?= $this->Html->link(__('List Terminals'), ['action' => 'index']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Airports'), ['controller' => 'Airports', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Airport'), ['controller' => 'Airports', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="terminals form large-9 medium-8 columns content">
    <?= $this->Form->create($terminal) ?>
    <fieldset>
		<legend><?= __('Edit Terminal') ?></legend>
        <?php
        echo $this->Form->control('airport_id', [
            'options' => $airports,
            'label' => __('Airports') . __('Chinese Name')
        ]);
        echo $this->Form->control('name', [
            'label' => __('Terminals') . __('Chinese Name')
        ]);
        echo $this->Form->control('sname', [
            'label' => __('Terminals') . __('Chinese Simple Name')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
