<?php
/* @var $this PatentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posts',
);

$this->menu=array(
	array('label'=>'Thêm mới', 'url'=>array('create')),
	array('label'=>'Quản lý', 'url'=>array('admin')),
    array('label'=>'Danh sách', 'url'=>array('index')),
);
?>

<h1>Tài liệu</h1>

<?php if(!empty($_GET['tag'])): ?>
    <h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'template'=>"{items}\n{pager}",
)); ?>
