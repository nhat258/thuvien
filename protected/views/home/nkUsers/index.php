<?php
/* @var $this NkUsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nk Users',
);

$this->menu=array(
	array('label'=>'Create NkUsers', 'url'=>array('create')),
	array('label'=>'Manage NkUsers', 'url'=>array('admin')),
);
?>

<h1>Nk Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
