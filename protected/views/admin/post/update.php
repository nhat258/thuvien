<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'Sáng chế'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('index')),
	array('label'=>'Sửa', 'url'=>array('create')),
	array('label'=>'Xem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Cập nhật sáng chế <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>