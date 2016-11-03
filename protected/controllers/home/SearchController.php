<?php

class SearchController extends HomeController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function actionAjaxUpdate()
	{
		$act = $_GET['act'];
		if ($act == 'doSortRank') {
			$sortOrderAll = $_POST['sortRank'];
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $id => $sortOrder) {
					$model       = $this->loadModel($id);
					$model->rank = $sortOrder;
					$model->save();
				}
			}
		} elseif ($act == 'doTitle') {
			$sortOrderAll = $_POST['setTitle'];
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $id => $title) {
					$model       = $this->loadModel($id);
					$model->title = $title;
					$model->save();
				}
			}
		} elseif ($act == 'doAuthor') {
			$sortOrderAll = $_POST['setAuthor'];
			if (count($sortOrderAll) > 0) {
				foreach ($sortOrderAll as $id => $author) {
					$model        = $this->loadModel($id);
					$model->author = $author;
					$model->save();
				}
			}
		} else {
			$autoIdAll = $_POST['autoId'];
			if (count($autoIdAll) > 0) {
				foreach ($autoIdAll as $autoId) {
					$model = $this->loadModel($autoId);
					if ($act == 'doDelete') {
						$model->delete();
					} else {
						if ($act == 'doActive')
							$model->status = 1;
						if ($act == 'doInactive')
							$model->status = 0;
						if ($act == 'doHome')
							$model->home = 1;
						if ($act == 'doNotHome')
							$model->home = 0;
						if ($act == 'doFeature')
							$model->feature = 1;
						if ($act == 'doNotFeature')
							$model->feature = 0;
						if ($model->save())
							echo 'ok';
						else
							throw new Exception("Sorry", 500);
					}
				}
			}
		}
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin','result'),
				'users'=>array('*'),
			),

		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $post=$this->loadModel($id);
        $comment=$this->newComment($post);

        $this->render('view',array(
            'model'=>$post,
            'comment'=>$comment,
        ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Post;
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if (isset($_POST['Post'])) {
			$model->attributes  = $_POST['Post'];
			//$model->dateCreated = new CDbExpression('NOW()');
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}
	
		$this->render('create', array(
				'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Post');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
	
		$this->render('admin',array(
				'model'=>$model,
		));
	}
	
	public function actionResult()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
	
		$this->render('result',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Patent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        $model=Post::model()->findByPk($id);
        if($model===null)
        {
            if(isset($_GET['id']))
            {
                if(Yii::app()->user->isGuest)
                    $condition='status='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
                else
                    $condition='';
                $this->_model=Post::model()->findByPk($_GET['id'], $condition);
            }
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Patent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    protected function newComment($post)
    {
        $comment=new Comment;
        if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
        {
            echo CActiveForm::validate($comment);
            Yii::app()->end();
        }
        if(isset($_POST['Comment']))
        {
            $comment->attributes=$_POST['Comment'];
            if($post->addComment($comment))
            {
                if($comment->status==Comment::STATUS_PENDING)
                    Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
                $this->refresh();
            }
        }
        return $comment;
    }
}
