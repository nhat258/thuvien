<?php

    /* @var $item Patent */
?>
<div id="new-product" class="list-product">
    <h3><?php echo $category->name?></h3>
    <?php $this->renderPartial('/site/posts', array('items' => $items))?>
    <?php //$this->renderPartial('/site/volumes', array('items' => $items))?>
</div>
<div id="pagination">
    <?php $this->widget('CLinkPager', array(
    'pages'       => $pages,
    'htmlOptions' => array('class' => 'pager'),
    'header'      => ''
));
    ?>
</div>