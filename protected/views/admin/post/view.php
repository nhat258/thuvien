<?php
$this->breadcrumbs=array(
    $model->title,
);
$this->pageTitle=$model->title;
$this->menu=array(
    array('label'=>'Thêm mới', 'url'=>array('create')),
    array('label'=>'Sửa', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Xóa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Danh sách', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_view', array(
    'data'=>$model,
)); ?>

<div id="comments">
    <?php if($model->commentCount>=1): ?>
        <h3>
            <?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : 'One comment'; ?>
        </h3>

        <?php $this->renderPartial('_comments',array(
            'post'=>$model,
            'comments'=>$model->comments,
        )); ?>
    <?php endif; ?>

    <h3>Leave a Comment</h3>

    <?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php $this->renderPartial('/comment/_form',array(
            'model'=>$comment,
        )); ?>
    <?php endif; ?>

</div><!-- comments -->
