<div id='navi'>
	<ul class="nav">
		<li><a href="#"><?= __('Flights') ?></a>
			<ul>
				<li><?= $this->Html->link(__('List Flights'), ['controller'=>'flights', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Flights Upload'), ['controller'=>'flights', 'action'=>'upload'])?></li>
			</ul></li>
		<li><a href="#"><?= __('Enterprises') ?></a>
			<ul>
				<li><?= $this->Html->link(__('List Enterprises'), ['controller'=>'enterprises', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Search').__('Enterprises'), ['controller'=>'enterprises', 'action'=>'search'])?></li>
			</ul></li>
		<li><a href="#"><?= __('Airports') ?></a>
			<ul>
				<li><?= $this->Html->link(__('List Airports'),['controller'=>'airports', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Search').__('Airports'),['controller'=>'airports', 'action'=>'search'])?></li>
				<li><?= $this->Html->link(__('List Terminals'),['controller'=>'terminals', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Search').__('Terminals'),['controller'=>'terminals', 'action'=>'search'])?></li>
			</ul></li>
		<li><a href="#"><?= __('Aircrafts') ?></a>
			<ul>
				<li><?= $this->Html->link(__('List Registers'),['controller'=>'registers', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Search').__('Registers'), ['controller'=>'registers', 'action'=>'search'])?></li>
				<li><?= $this->Html->link(__('List Aircrafts'),['controller'=>'aircrafts', 'action'=>'index'])?></li>
				<li><?= $this->Html->link(__('Search').__('Aircrafts'), ['controller'=>'aircrafts', 'action'=>'search'])?></li>
			</ul></li>
	</ul>
</div>
<div class="clear"></div>