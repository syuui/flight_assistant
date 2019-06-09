<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight[]|\Cake\Collection\CollectionInterface $flights
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('New Flight'), ['action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Enterprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Enterprise'), ['controller' => 'Enterprises', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Aircraft'), ['controller' => 'Aircrafts', 'action' => 'add']) ?></li>
		<hr>
		<li><?= $this->Html->link(__('List Terminals'), ['controller' => 'Terminals', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('New Terminal'), ['controller' => 'Terminals', 'action' => 'add']) ?></li>
	</ul>
</nav>
<div class="flights index large-9 medium-8 columns content">
	<h3><?= __('Flights') ?></h3>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th scope="col"><?= $this->Paginator->sort('enterprise_id', __('Enterprises')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('number', __('Flight Number')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('register_id', __('Registers')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('ori_terminal_id', __('Origin Terminal') ) ?></th>
				<th scope="col"><?= $this->Paginator->sort('ori_datetime', __('Origin Datetime')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('gate', __('Gate')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('des_terminal_id', __('Destination Terminal')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('des_datetime', __('Destination Datetime')) ?></th>
				<th scope="col"><?= $this->Paginator->sort('seat', __('Seat Number')) ?></th>
				<th scope="col" class="actions"><?= __('Actions') ?></th>
			</tr>
		</thead>
		<tbody>
            <?php   foreach ($flights as $flight) :     ?>
            <tr>
				<td><?= $flight->has('enterprise') ? $this->Html->link($flight->enterprise->sname, ['controller' => 'Enterprises', 'action' => 'view', $flight->enterprise->id]) : '' ?></td>
				<td><?= h($flight->enterprise->iata).h($flight->number) ?></td>
				<td><?php
                if ($flight->has('register')) :
                    echo $this->Html->link($flight->register->register, [
                        'controller' => 'Registers',
                        'action' => 'view',
                        $flight->register->id
                    ]);
                    if ($flight->register->has('aircraft')) :
                        echo "(" . $this->Html->link($flight->register->aircraft->type, [
                            'controller' => 'Aircrafts',
                            'action' => 'view',
                            $flight->register->aircraft->id
                        ]) . ")";
                     else :
                        echo "(-)";
                    endif;
                
                
                
                
                endif;
                ?></td>
				<td><?= $this->Html->link(h($flight->ori_terminal->airport->sname).h($flight->ori_terminal->sname), ['controller' => 'Terminals','action' => 'view',$flight->ori_terminal_id])?></td>
				<td><?= h($this->Time->format($flight->ori_datetime, 'yyyy-MM-dd HH:mm', null));?></td>
				<td><?= h($flight->gate) ?></td>
				<td><?= $this->Html->link(h($flight->des_terminal->airport->sname).h($flight->des_terminal->sname), ['controller'=>'Terminals', 'action'=>'view', $flight->des_terminal_id]) ?></td>
				<td><?= h($this->Time->format($flight->des_datetime, 'yyyy-MM-dd HH:mm', null)) ?></td>
				<td><?= h($flight->seat) ?></td>
				<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $flight->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $flight->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $flight->id], ['confirm' => __('Are you sure you want to delete # {0}?', $flight->id)]) ?>
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
</div>
