<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl('search/result'),
    'method' => 'get',
)); ?>
<!--    <table>-->
<!--        <tr>-->
<!--            <td>-->
<!--                <div class="row">-->
<!--                    --><?php //echo $form->labelEx($model,'Từ ngày'); ?>
<!--                    --><?php
//                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'model'=>$model,
//                        'attribute'=>'date1',
//                        'value' => null,
//                        'options' => array(
//                            'dateFormat' => 'yy-mm-dd',     // format of "25-12-2015"
//                        ),
//                        'htmlOptions' => array(
//                            'size' => '10',         // textField size
//                            'maxlength' => '10',    // textField maxlength
//                        ),
//                    ));
//                    ?>
<!--                    --><?php //echo $form->error($model,'date1'); ?>
<!--                </div>-->
<!--            </td>-->
<!--            <td>-->
<!--                <div class="row">-->
<!--                    --><?php //echo $form->labelEx($model,'Đến ngày'); ?>
<!--                    --><?php
//                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                        'model'=>$model,
//                        'attribute'=>'date2',
//                        'value' => null,
//                        'options' => array(
//                            'dateFormat' => 'yy-mm-dd',     // format of "25-12-2015"
//                        ),
//                        'htmlOptions' => array(
//                            'size' => '10',         // textField size
//                            'maxlength' => '10',    // textField maxlength
//                        ),
//                    ));
//                    ?>
<!--                    --><?php //echo $form->error($model,'date2'); ?>
<!--                </div>-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->
    <div class="row">
        <?php echo $form->label($model, 'categoryId'); ?>
        <?php echo $form->dropDownList($model, 'categoryId', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('empty' => '(Chọn thể loại)')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 100, 'maxlength' => 500)); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Tìm kiếm'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->