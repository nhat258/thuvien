
<h3>Kết quả</h3>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => TRUE,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'             => 'post-grid',
    'dataProvider'   => $model->search(),
    'filter'         => $model,
    'selectableRows' => 2,
    'columns'        => array(
        'id',
		'title',
		array
		(
		    'class'=>'CButtonColumn',
		    'template'=>'{view}',
		    'buttons'=>array
		    (
		        'view' => array
		        (
		            'label'=>'Xem thông tin chi tiết tài liệu',
		            //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',		       
		        ),
		    )
		),
    ),
)); ?>
</div>
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

