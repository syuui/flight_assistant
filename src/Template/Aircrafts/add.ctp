<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aircraft $aircraft
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['action' => 'index']) ?></li>
	</ul>
</nav>
<div class="aircrafts form large-9 medium-8 columns content">
    <?= $this->Form->create($aircraft) ?>
    <fieldset>
		<legend><?= __('New Aircraft') ?></legend>
        <?php
        echo $this->Form->control('type', [
            'label' => __('type')
        ]);
        echo $this->Form->control('maker', [
            'label' => __('maker')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
