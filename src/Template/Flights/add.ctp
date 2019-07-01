<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Flight $flight
 */

//  设置默认的日期字段格式为 YYYY-MM-DD    hh:mm
$this->Form->templates([
    'dateWidget' => __('DateWidget')
]);

?>
<?= $this->Html->scriptStart() ?>
function getJson() {
    var enters = JSON.parse("<?= str_replace('"', '\"', json_encode($enterList))?>");
    var terms  = JSON.parse("<?= str_replace('"', '\"', json_encode(array_flip($terminals->toArray())))?>");
    $.get("http://localhost/ajax/get_flight_info/" + enters[$("#enterprise-id").val()] + $("#number").val(), function(data, status) {
        dataObj = eval("(" + data + ")");
        if( dataObj.flightInfo == null ) {
            alert('<?=__('Failed to fetch flight information') ?>');
        } else {
            //  Set Values
            $("#ori-terminal-id").val( terms[dataObj.flightInfo.depart_terminal] );
            $("#ori-terminal-id").parent().addClass("ok-icon");
            $("#des-terminal-id").val( terms[dataObj.flightInfo.arriv_terminal] );
            $("#des-terminal-id").parent().addClass("ok-icon");

            dt = dataObj.flightInfo.depart_time.split(":");
            $("#ori_dth").val(dt[0]);
            $("#ori_dtm").val(dt[1]);
            $("#ori_dth").parent().addClass("ok-icon");

            dt = dataObj.flightInfo.arriv_time.split(":");
            $("#des_dth").val(dt[0]);
            $("#des_dtm").val(dt[1]);
            $("#des_dth").parent().addClass("ok-icon");
        }
    });
}

function nestedReg(){
    var regs = JSON.parse("<?= str_replace('"', '\"', json_encode($rgs)) ?>");

    $("#register-id").empty();

    for( var i=0; i < regs[$("#enterprise-id").val()].length; i++ )
    {
        var	option=$("<option>").val(regs[$("#enterprise-id").val()][i]['id']).text(regs[$("#enterprise-id").val()][i]['register']);
        $("#register-id").append(option);       
    }
}

function nestedDate()
{
    $("#des_year").val( $("#ori_year").val() );
    $("#des_month").val( $("#ori_month").val() );
    $("#des_day").val( $("#ori_day").val() );
}

<?= $this->Html->scriptEnd() ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
		<ul class="side-nav">
			<li class="heading"><?= __('Actions') ?></li>
			<li><?= $this->Html->link(__('List Flights'), ['action' => 'index']) ?></li>
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
	<div class="flights form large-9 medium-8 columns content">
    <?= $this->Form->create($flight) ?>
    <fieldset>
			<legend><?= __('New Flight') ?></legend>
        <?php
        echo $this->Form->control('enterprise_id', [
            // 'options' => $enterprises,
            'options' => $enterprises,
            'label' => __('Enterprises'),
            'onchange' => 'nestedReg();'
        ]);
        echo $this->Form->button(__('Get flight infomation automaticly'), [
            'id' => 'B01',
            'type' => 'button',
            'class' => [
                'inline',
                'right'
            ],
            'onclick' => 'getJson();'
        ]);
        echo $this->Form->control('number', [
            'label' => __('Flight Number')
        ]);
        echo $this->Form->control('register_id', [
            'label' => __('Registers')
        ]);
        echo $this->Form->control('ori_terminal_id', [
            'options' => $terminals,
            'label' => __('Origin Terminal')
        ]);
        echo $this->Form->control('ori_datetime', [
            'label' => __('Origin Datetime'),
            'year' => [
                'onchange'=>'nestedDate()',
                'id'=>'ori_year'
            ],
            'month' => [
                'onchange'=>'nestedDate()',
                'id'=>'ori_month'
            ],
            'day' =>[
                'onchange'=>'nestedDate()',
                'id'=>'ori_day'
            ],
            'hour' => [
                'id' => 'ori_dth'
            ],
            'minute' => [
                'id' => 'ori_dtm'
            ],
            'interval' => 5
        ]);
        echo $this->Form->control('gate', [
            'label' => __('Gate')
        ]);
        echo $this->Form->control('des_terminal_id', [
            'options' => $terminals,
            'label' => __('Destination Terminal')
        ]);
        echo $this->Form->control('des_datetime', [
            'label' => __('Destination Datetime'),
            'year' => [
                'id'=>'des_year'
            ],
            'month' => [
                'id'=>'des_month'
            ],
            'day' =>[
                'id'=>'des_day'
            ],
            'hour' => [
                'id' => 'des_dth'
            ],
            'minute' => [
                'id' => 'des_dtm'
            ],
            'interval' => 5
        ]);
        echo $this->Form->control('seat', [
            'label' => __('Seat Number')
        ]);
        echo $this->Form->control('memo', [
            'label' => __('Memory')
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->scriptStart()  ?>
    nestedReg();
<?= $this->Html->scriptEnd() ?>
