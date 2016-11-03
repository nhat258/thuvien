<?php
    /* @var $item Patent */
?>
<div id="detail">
    <h3><?php echo $model->name?></h3>
   
    <table width="100%" border="1">  
    	<tr>
    		<td colspan=4 align="center" height="30px"><b>Tên CD: </b><?php echo $model->name?><br>  </td>
    	</tr>
    	   
    	<tr>
    		<td width="20%" height="30px"><b>Thời gian </b></td>
    		<td  height="30px" colspan=3 align="center"><?php echo $time?></td>
    	</tr> 	
    	<tr>
    		<td width="20%" height="30px"><b>Mô tả </b></td>
    		<td  height="30px" colspan=3 align="center"><?php echo $info?></td>
    	</tr> 	
  
  	</table>       
    <div class="clr"></div>
</div>

<!-- <div id="new-product" class="list-product">
    <h3>Sản phẩm cùng loại</h3>
    <?php // $this->renderPartial('/site/patents', array('items' => $items))?>
</div>   -->


