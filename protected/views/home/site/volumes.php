<?php
/**
 * Created by $Mitonios Editor.
 * User: $Mitonios
 * Date: 1/03/13
 * Time: 3:18 PM
 */
/* @var $item PatentCD */
?>
<ul>
    <?php
    if (!empty($items)) {
        foreach ($items as $item) {
            ?>
            <li>
                <a class="preview" href="<?php echo Yii::app()->request->baseUrl . $item->avatar ?>"
                   onclick="window.location.href='<?php echo $this->createUrl('/site/detailPt', array('id' => $item->id)) ?>';return false;">
                    <div style="padding-bottom: 5px;">
                        <img width="100"
                             src="<?php echo Nako::phpThumb(Yii::app()->request->baseUrl . $item->avatar, 135) ?>">
                    </div>
                </a>

                <p>
                 
                    <span class="price"><?php echo $item->name ?></span>
                </p>
            </li>
        <?php
        }
    }
    ?>
</ul>
