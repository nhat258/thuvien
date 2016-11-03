<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Tạo mới', 'url'=>array('create')),
	array('label'=>'Xem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Danh sách', 'url'=>array('admin')),
);
?>

<h1>Cập nhật <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>