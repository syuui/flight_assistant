<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal $terminal
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Terminals'), ['action' => 'index']) ?></li>
        <hr>
        <li><?= $this->Html->link(__('List Airports'), ['controller' => 'Airports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Airport'), ['controller' => 'Airports', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="terminals form large-9 medium-8 columns content">
    <?= $this->Form->create($terminal) ?>
    <fieldset>
        <legend><?= __('Add Terminal') ?></legend>
        <?php
            echo $this->Form->control('airport_id', ['options' => $airports]);
            echo $this->Form->control('name');
            echo $this->Form->control('sname');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
