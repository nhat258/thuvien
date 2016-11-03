<?php
/* @var $this NkUsersController */
/* @var $model NkUsers */

$this->breadcrumbs=array(
	'Nk Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NkUsers', 'url'=>array('index')),
	array('label'=>'Manage NkUsers', 'url'=>array('admin')),
);
?>

<h1>Create NkUsers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>