<?php
/**
 * Created by PhpStorm.
 * User: NHAT
 * Date: 07/03/2016
 * Time: 5:29 PM
 */
?>

<div class="post">
    <div>
        <h3><?php echo CHtml::link(CHtml::encode($data->title), $data->urlhome); ?></h3>
    </div>
    <!--    <div class="author">-->
    <!--        posted by --><?php //echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
    <!--    </div>-->
    <br/>
    <div class="content">
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
        echo $data->content;
        $this->endWidget();
        ?>
    </div>
    <div>
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$data,
            'attributes'=>array(
                'spc',
                'country',
                'dockind',
                'authorname',
                'quote',
                'totalpage',
                'filesize',
            ),
        )); ?>
    </div>
    <br/>
<!--    --><?php
        echo "<b>".$data->filename."</b>" ;
//    ?>
    <br /><a href="/thuvien/download.php">Download PDF</a>
<!--    <a href="E:/upload/--><?php //$data->filename ?><!--" </a>-->
    <div class="nav">
        <b>Tags:</b>
        <?php echo implode(', ', $data->tagLinksHome); ?>
        <br/>
        <?php echo CHtml::link('Permalink', $data->urlhome); ?> |
        <?php echo CHtml::link("Comments ({$data->commentCount})",$data->urlhome.'#comments'); ?> |
        Last updated on <?php echo date('F j, Y',$data->update_time); ?>
    </div>
</div>
<br/>
