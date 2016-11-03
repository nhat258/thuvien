<style>
a:link {text-decoration:none; color:#3d3d3d}    /* unvisited link */
a:visited {text-decoration:none;} /* visited link */
a:hover {text-decoration:underline;}   /* mouse over link */
a:active {text-decoration:underline;}  /* selected link */
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/home/style.css" />
<div class="divTable">
    <div class="divRow">
        <div class="divCell0">
            STT
        </div>
        <div class="divCell" style="padding-left: 260px; font-weight: bold">
            TÊN TÀI LIỆU
        </div>
    </div>
    <?php
    $count = 0;
    if (!empty($items)) {
        foreach ($items as $item) {
            $count ++ ;
            ?>
            <div class="divRow">
                <div class="divCell0">
                    &nbsp; <?php echo $count ?>.
                </div>
                <div class="divCell">
                    <a href="<?php echo $this->createUrl('/site/detail', array('id' => $item->id)) ?>"
                       onclick="window.location.href='<?php echo $this->createUrl('/site/detail', array('id' => $item->id)) ?>//';return false;">
                        <?php echo $item->title?></a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>