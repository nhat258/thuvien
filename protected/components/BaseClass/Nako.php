<?php

class Nako
{
	public static function phpThumb($path, $width = '', $height = '', $crop = FALSE)
	{
		//if ($path == '')
		return $path;
		if (strstr($path, 'http'))
			return $path;
		$path = urlencode($_SERVER['HTTP_HOST'] . $path);
			//            $return = 'http://cdn.wapme.vn/thumbnail/phpThumb.php?src=http://' . $path . '&w=' . $width . '&h=' . $height;
		$return = '/phpthumb/phpThumb.php?src=' . $path . '&w=' . $width . '&h=' . $height;
		if ($crop)
			$return .= '&zc=1';
		return $return;
	}

	public static function danhsachchuyenmuc()
	{
		//Trang chu
		$node = '<ul  class="navigation">';
		$categories = Category::model()->findAll(array('condition' => 'parentId is NULL', 'order' => 'rank DESC'));
		foreach ($categories as $cat) {
			$node .= '<li>' . CHtml::link($cat->name, '#');
			if (isset($cat->categories)) {
				$children = $cat->categories;
				$node .= '<ul>';
				foreach ($children as $child) {
					$node .= '<li>' . CHtml::link($child->name, Yii::app()->urlManager->createUrl('/site/list', array('id' => $child->id))) . '</li>';
				}
				$node .= '</ul>';
			}
			$node .= '</li>';
		}
		$node .= '</ul>';
		echo $node;
	}
	

}
