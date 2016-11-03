<?php
    /* @var $this PatentController */
    /* @var $model Patent */
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/imageTooltip.js');
    $this->breadcrumbs = array(
        'Tài liệu' => array('index'),
        'Quản lý',
    );

    $this->menu = array(
        array('label' => 'Thêm mới', 'url' => array('create')),
        array('label'=>'Danh sách', 'url'=>array('index')),
    );

    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Danh sách </h1>

<?php echo CHtml::link('Tìm kiếm/ Thống kê', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->
<?php $form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'             => 'post-grid',
    'dataProvider'   => $model->search(),
    'filter'         => $model,
    'selectableRows' => 2,
    'columns'        => array(
        array(
            'id'             => 'autoId',
            'class'          => 'CCheckBoxColumn',
            'selectableRows' => '5',
        ),
	  array(
            'name'   => 'STT',
            'value'  => null,
            'type'   => 'raw',
            'filter' => FALSE,
            'sortable'   => FALSE,
        ),
        'id',
        array(
            'name'        => 'title',
            'value'       => 'CHtml::textArea("sortRank[$data->id]",$data->title,array("style"=>"width:400px;height:50px"))',
            'type'        => 'raw',
            'htmlOptions' => array("width" => "400px"),
        ),
        array(
            'name'   => 'categoryId',
            'value'  => 'isset($data->category)?$data->category->name:""',
            'filter' => CHtml::activeDropDownList($model, 'categoryId', CHtml::listData(Category::model()->findAll(), "id", "name"), array("empty" => "Chọn thể loại")),
            'htmlOptions' => array("width" => "120px"),
        ),
        array(
            'name'        => 'tags',
            'value'       => null,
            'type'        => 'raw',
            'htmlOptions' => array("width" => "100px"),
        ),
        array(
            'name'=>'status',
            'value'=>'Lookup::item("PostStatus",$data->status)',
            'filter'=>Lookup::items('PostStatus'),
        ),
//        array(
//            'name'   => 'home',
//            'value'  => '$data->home==1?"Có":"Không"',
//            'filter' => array(1 => 'Có', 0 => 'Không'),
//        ),
//        array(
//            'name'   => 'feature',
//            'value'  => '$data->feature==1?"Có":"Không"',
//            'filter' => array(1 => 'Có', 0 => 'Không'),
//        ),
//		'date1',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
<script>
    function reloadGrid(data) {
        $.fn.yiiGridView.update('post-grid');
    }
</script>
    <span>Tick chọn:</span>
<?php echo CHtml::ajaxSubmitButton('Filter', array('post/ajaxUpdate'), array(), array("style" => "display:none;")); ?>
<?php echo CHtml::ajaxSubmitButton('Hiện', array('post/ajaxUpdate', 'act' => 'doActive'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Ẩn', array('post/ajaxUpdate', 'act' => 'doInactive'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Đưa lên Home', array('post/ajaxUpdate', 'act' => 'doHome'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Gỡ khỏi Home', array('post/ajaxUpdate', 'act' => 'doNotHome'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Nổi bật', array('post/ajaxUpdate', 'act' => 'doFeature'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Không nổi bật', array('post/ajaxUpdate', 'act' => 'doNotFeature'), array('success' => 'reloadGrid')); ?>
<br/>
    <span>Không cần tick chọn: </span>
<?php //echo CHtml::ajaxSubmitButton('Cáº­p nháº­t tÃªn', array('product/ajaxUpdate', 'act' => 'doName'), array('success' => 'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Cập nhật thứ hạng', array('post/ajaxUpdate', 'act' => 'doSortRank'), array('success' => 'reloadGrid')); ?>
<?php //echo CHtml::ajaxSubmitButton('Cáº­p nháº­t giÃ¡', array('product/ajaxUpdate', 'act' => 'doPrice'), array('success' => 'reloadGrid')); ?>
|
<?php echo CHtml::ajaxSubmitButton('Xóa', array('post/ajaxUpdate', 'act' => 'doDelete'), array('success' => 'reloadGrid', 'beforeSend' => 'function(){
            return confirm("Bạn chắc chắn xóa những tài liệu đã chọn?")
        }',)); ?>
<?php $this->endWidget(); ?>

<style>
    #preview {
        position: absolute;
        border: 1px solid #ccc;
        background: #333;
        padding: 5px;
        display: none;
        color: #fff;
    }

    #preview img {
        max-width: 500px;
        max-height: 500px;
    }
</style>