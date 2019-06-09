<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airport[]|\Cake\Collection\CollectionInterface $airports
 */
$action = $this->request->getParam('action');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Airport'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="airports index large-9 medium-8 columns content">
    <h3><?= __('Airports') ?></h3>
    
    <?php
    if ($action === 'search') :
        ?>
                <div id='search'>
            <?=$this->Form->create('Search', ['type' => 'POST','url' => ['controller' => 'airports','action' => 'search']]);?>
            <?=$this->Form->control('key',['type'=>'text','label'=>false,'placeholder'=>'关键字'])?>
            <?=$this->Form->submit('搜索',['inputContainer'=>false])?>
            <?=$this->Form->end();?>
            </div>
    
    
    <?php 
    endif;
    if (empty($airports)) :
        ?>
    <h3><?= __('No Result');?></h3>
    
     <?php    else :        ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', __('Chinese Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('sname', __('Chinese Simple Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('ename', __('English Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('IATA', __('IATA Code')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('ICAO', __('ICAO Code')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($airports as $airport): ?>
            <tr>
                <td><?= h($airport->name) ?></td>
                <td><?= h($airport->sname) ?></td>
                <td><?= h($airport->ename) ?></td>
                <td><?= h($airport->IATA) ?></td>
                <td><?= h($airport->ICAO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $airport->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $airport->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $airport->id], ['confirm' => __('Are you sure you want to delete # {0}?', $airport->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <?php endif;?>
</div>
