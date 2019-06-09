<div id='search'>
<?php
echo $this->Form->create('Search', [
    'type' => 'POST',
    'url' => [
        'controller' => 'common',
        'action' => 'search'
    ],
    'onclick' => 'alert("' . __('Not in use') . '"); return false;'
]);

echo $this->Form->control('keyword', [
    'type' => 'text',
    'label' => false,
    'placeholder' => '关键字'
]);

echo $this->Form->submit('搜索', [
    'inputContainer' => false
]);

echo $this->Form->end();
?>
</div>
<div class="clear"></div>
