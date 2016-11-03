<?php
/* @var $this NkUsersController */
/* @var $model NkUsers */

$this->breadcrumbs=array(
	'Nk Users'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List NkUsers', 'url'=>array('index')),
	array('label'=>'Create NkUsers', 'url'=>array('create')),
	array('label'=>'View NkUsers', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage NkUsers', 'url'=>array('admin')),
);
?>

<h1>Update NkUsers <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>