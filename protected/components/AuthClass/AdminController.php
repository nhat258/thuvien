<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{
	public $layout='column1';
	public $menu=array();
	public $breadcrumbs=array();
	public function filters()
	{
		return array(
				'accessControl',
		);
	}
	public function accessRules()
	{
		return array(
				array('allow',
						'users'=>array('*'),
						'actions'=>array('login'),
				),
				array('allow',
						'users'=>array('@'),
				),
				array('deny',
						'users'=>array('*'),
				),
		);
	}
}