<?php
/* @var $this NkUsersController */
/* @var $model NkUsers */

$this->breadcrumbs=array(
	'Nk Users'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List NkUsers', 'url'=>array('index')),
	array('label'=>'Create NkUsers', 'url'=>array('create')),
	array('label'=>'Update NkUsers', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete NkUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NkUsers', 'url'=>array('admin')),
);
?>

<h1>View NkUsers #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'user_login',
		'user_pass',
		'user_nicename',
		'user_email',
		'user_url',
		'user_registered',
		'user_activation_key',
		'user_status',
		'display_name',
	),
)); ?>
