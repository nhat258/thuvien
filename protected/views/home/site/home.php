<style>
a:link {text-decoration:none; color:#0044cc}    /* unvisited link */
a:visited {text-decoration:none;} /* visited link */
a:hover {text-decoration:underline;}   /* mouse over link */
a:active {text-decoration:underline;}  /* selected link */
</style>

<?php if(!empty($_GET['tag'])): ?>
    <h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'view',
    'template'=>"{items}\n{pager}",
)); ?>