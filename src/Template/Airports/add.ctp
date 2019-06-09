<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport $airport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Airports'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="airports form large-9 medium-8 columns content">
    <?= $this->Form->create($airport) ?>
    <fieldset>
        <legend><?= __('New Airport') ?></legend>
        <?php
        echo $this->Form->control('name', [
            'label' => __('Chinese Name')
        ]);
        echo $this->Form->control('sname', [
            'label' => __('Chinese Simple Name')
        ]);
        echo $this->Form->control('ename', [
            'label' => __('English Name')
        ]);
        echo $this->Form->control('IATA', [
            'label' => __('IATA Code')
        ]);
        echo $this->Form->control('ICAO', [
            'label' => __('ICAO Code')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
