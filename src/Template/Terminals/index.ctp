<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Terminal[]|\Cake\Collection\CollectionInterface $terminals
 */
$action = $this->request->getParam('action');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Terminal'), ['action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Airports'), ['controller' => 'Airports', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Airport'), ['controller' => 'Airports', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="terminals index large-9 medium-8 columns content">
	<h3><?= __('Terminals') ?></h3>
    
    <?php
    if ($action === 'search') :
        ?>
                <div id='search'>
            <?=$this->Form->create('Search', ['type' => 'POST','url' => ['controller' => 'terminals','action' => 'search']]);?>
            <?=$this->Form->control('key',['type'=>'text','label'=>false,'placeholder'=>'关键字'])?>
            <?=$this->Form->submit('搜索',['inputContainer'=>false])?>
            <?=$this->Form->end();?>
            </div>    
    
    <?php 
    endif;
    if (empty($terminals)) :
        ?>
    <h3><?= __('No Result');?></h3>
    
     <?php    else :        ?>
    <table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('airport_id', __('Airports') . __('Chinese Name')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('name', __('Terminals'). __('Chinese Name')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('sname',__('Terminals'). __('Chinese Simple Name')) ?></th>
				<th scope="col" class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($terminals as $terminal): ?>
            <tr>
				<td><?= $terminal->has('airport') ? $this->Html->link($terminal->airport->name, ['controller' => 'Airports', 'action' => 'view', $terminal->airport->id]) : '' ?></td>
				<td><?= h($terminal->name) ?></td>
				<td><?= h($terminal->sname) ?></td>
				<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $terminal->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $terminal->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $terminal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->id)]) ?>
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
