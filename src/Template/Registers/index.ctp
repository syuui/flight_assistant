<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Register[]|\Cake\Collection\CollectionInterface $registers
 */
$action = $this->request->getParam('action');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Register'), ['action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="registers index large-9 medium-8 columns content">
	<h3><?= __('Registers') ?></h3>
    
    <?php
    if ($action === 'search') :
        ?>
                <div id='search'>
            <?=$this->Form->create('Search', ['type' => 'POST','url' => ['controller' => 'registers','action' => 'search']]);?>
            <?=$this->Form->control('key',['type'=>'text','label'=>false,'placeholder'=>'关键字'])?>
            <?=$this->Form->submit('搜索',['inputContainer'=>false])?>
            <?=$this->Form->end();?>
            </div>
    
    
    
    <?php 
    endif;
    if (empty($registers)) :
        ?>
    <h3><?= __('No Result');?></h3>
    
     <?php    else :        ?>
    <table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('register', __('Registers')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('enterprise_id', __('Chinese Name')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('aircraft_id', __('type')) ?></th>
				<th scope="col" class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($registers as $register): ?>
            <tr>
				<td><?= h($register->register) ?></td>
				<td><?= $register->has('enterprise') ? $this->Html->link($register->enterprise->name, ['controller' => 'Enterprises', 'action' => 'view', $register->enterprise->id]) : '' ?></td>
				<td><?= $register->has('aircraft') ? $this->Html->link($register->aircraft->type, ['controller' => 'Aircrafts', 'action' => 'view', $register->aircraft->id]) : '' ?></td>
				<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $register->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $register->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $register->id], ['confirm' => __('Are you sure you want to delete # {0}?', $register->id)]) ?>
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
