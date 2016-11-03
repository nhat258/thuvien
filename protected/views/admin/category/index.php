<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thể loại',
);

$this->menu=array(
	array('label'=>'Thêm mới', 'url'=>array('create')),
	array('label'=>'Danh sách', 'url'=>array('admin')),
);
?>

<h1>Thể loại</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
