<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enterprise $enterprise
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Enterprises'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="enterprises form large-9 medium-8 columns content">
    <?= $this->Form->create($enterprise) ?>
    <fieldset>
        <legend><?= __('New Enterprise') ?></legend>
        <?php
            echo $this->Form->control('name',['label'=>__('Chinese Name')]);
            echo $this->Form->control('sname',['label'=>__('Chinese Simple Name')]);
            echo $this->Form->control('ename',['label'=>__('English Name')]);
            echo $this->Form->control('iata',['label'=>__('IATA Code')]);
            echo $this->Form->control('icao',['label'=>__('ICAO Code')]);
            echo $this->Form->control('url',['label'=>__('Website')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
