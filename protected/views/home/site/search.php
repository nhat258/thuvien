<?php
    /* @var $item Patent */
?>
<div id="new-patent" class="list-patent">
    <h3>Tìm kiếm: <?php echo $_REQUEST['v']?></h3>
    <?php $this->renderPartial('/site/posts', array('items' => $items, 'pages' =>$pages))?>
</div>
<div id="pagination">
    <?php $this->widget('CLinkPager', array(
    'pages'       => $pages,
    'htmlOptions' => array('class' => 'pager'),
    'header'      => ''
));
    ?>
</div>