<?php
/* @var $this PatentController */
/* @var $model Patent */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id'                   => 'post-form',
    'enableAjaxValidation' => FALSE,
    'htmlOptions'          => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>80,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php echo CHtml::activeTextArea($model,'content',array('rows'=>10, 'cols'=>70)); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'spc'); ?>
        <?php echo $form->textField($model,'spc',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'spc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'country'); ?>
        <?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'country'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'dockind'); ?>
        <?php echo $form->textField($model,'dockind',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'dockind'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'filename'); ?>
        <?php echo $form->textField($model,'filename',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'filename'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'authorname'); ?>
        <?php echo $form->textField($model,'authorname',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'authorname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'quote'); ?>
        <?php echo $form->textArea($model,'quote',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'quote'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'totalpage'); ?>
        <?php echo $form->textField($model,'totalpage',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'totalpage'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'filesize'); ?>
        <?php echo $form->textField($model,'filesize',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'filesize'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'filepath'); ?>
        <?php echo $form->textField($model,'filepath',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'filepath'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'fileext'); ?>
        <?php echo $form->textField($model,'fileext',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'fileext'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'topic'); ?>
        <?php echo $form->textField($model,'topic',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'topic'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'tags'); ?>
        <?php $this->widget('CAutoComplete', array(
            'model'=>$model,
            'attribute'=>'tags',
            'url'=>array('suggestTags'),
            'multiple'=>true,
            'htmlOptions'=>array('size'=>50),
        )); ?>
        <p class="hint">Please separate different tags with commas.</p>
        <?php echo $form->error($model,'tags'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->