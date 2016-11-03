<?php
/* @var $this PatentController */
/* @var $model Patent */

$this->breadcrumbs=array(
	'Tài liệu'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('index')),
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Thêm mới tài liệu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>