<style>
a:link {text-decoration:none; color:#3d3d3d}    /* unvisited link */
a:visited {text-decoration:none;} /* visited link */
a:hover {text-decoration:underline;}   /* mouse over link */
a:active {text-decoration:underline;}  /* selected link */
.icon {
            background: url(<?php echo Yii::app()->request->baseUrl?>/images/icon.png) no-repeat;
            border: none;
            height: 35px;
            width: 35px;
            margin-left: 10px;
            padding-left: 30px;
        }
</style>
<?php
/* @var $item PatentCD */
?>
<ul>
    <?php
    if (!empty($items)) {
        foreach ($items as $item) {
            ?>
            <li>             
				<p> 
				                    
                <a style: href="<?php echo $this->createUrl('/site/detailType', array('id' => $item->id)) ?>"
                   onclick="window.location.href='<?php echo $this->createUrl('/site/detailType', array('id' => $item->id)) ?>';return false;">
               <span class="icon"><?php echo $item->name?></span><span class="space"></a>
               </p> 
            </li>
        <?php
        }
    }
    ?>
</ul>
