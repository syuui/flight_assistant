<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Register $register
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Register'), ['action' => 'edit', $register->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Register'), ['action' => 'delete', $register->id], ['confirm' => __('Are you sure you want to delete # {0}?', $register->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Registers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Register'), ['action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="registers view large-9 medium-8 columns content">
    <h3><?= h($register->register) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($register->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registers') ?></th>
            <td><?= h($register->register) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chinese Name') ?></th>
            <td><?= $register->has('enterprise') ? $this->Html->link($register->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $register->enterprise->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('type') ?></th>
            <td><?= $register->has('aircraft') ? $this->Html->link($register->aircraft->type, ['controller' => 'Aircrafts', 'action' => 'view', $register->aircraft->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($register->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($register->updated) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Memo') ?></h4>
        <?= $this->Text->autoParagraph(h($register->memo)); ?>
    </div>
</div>
