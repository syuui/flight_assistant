<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aircraft[]|\Cake\Collection\CollectionInterface $aircrafts
 */
$action = $this->request->getParam('action');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Aircraft'), ['action' => 'add']) ?></li>
	</ul>
</nav>
<div class="aircrafts index large-9 medium-8 columns content">
	<h3><?= __('Aircrafts') ?></h3>
    
    <?php
    if ($action === 'search') :
        ?>
    <div id='search'>
            <?=$this->Form->create('Search', ['type' => 'POST','url' => ['controller' => 'aircrafts','action' => 'search']]);?>
            <?=$this->Form->control('key',['type'=>'text','label'=>false,'placeholder'=>'关键字'])?>
            <?=$this->Form->submit('搜索',['inputContainer'=>false])?>
            <?=$this->Form->end();?>
    </div>
    

    <?php
    endif;
    if (empty($aircrafts)) :
        ?>
    <h3><?= __('No Result');?></h3>
    
     <?php    else :        ?>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('type', __('aircraft type')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('maker', __('maker')) ?></th>
				<th scope="col" class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($aircrafts as $aircraft): ?>
            <tr>
				<td><?= h($aircraft->type) ?></td>
				<td><?= h($aircraft->maker) ?></td>
				<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $aircraft->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aircraft->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aircraft->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aircraft->id)]) ?>
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
