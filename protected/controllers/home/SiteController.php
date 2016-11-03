<?php

class SiteController extends HomeController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Home page
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->pageTitle = 'Tailieu';
        $criteria=new CDbCriteria(array(
            'condition'=>'status='.Post::STATUS_PUBLISHED,
            'order'=>'id, update_time DESC',
            'with'=>'commentCount',
        ));
        if(isset($_GET['tag']))
            $criteria->addSearchCondition('tags',$_GET['tag']);
        $dataProvider=new CActiveDataProvider('Post', array(
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['postsPerPage'],
            ),
            'criteria'=>$criteria,
        ));
        $this->render('home',array(
            'dataProvider'=>$dataProvider,
        ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
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
     * Creates a new comment.
     * This method attempts to create a new comment based on the user input.
     * If the comment is successfully created, the browser will be redirected
     * to show the created comment.
     * @param Post the post that the new comment belongs to
     * @return Comment the comment instance
     */
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
	public function actionList($id)
	{
		$category            = Category::model()->findByPk($id);
		$this->pageTitle     = $category->name;
		$criteria            = new CDbCriteria();
		$criteria->condition = 'status=2 AND categoryId=' . $category->id;
		$criteria->order     = 'id DESC';
	
		$count = Post::model()->count($criteria);
		$pages = new CPagination($count);
		//results per page
		$pages->pageSize = 16;
		$pages->applyLimit($criteria);
		$items = Post::model()->findAll($criteria);
		$this->render('list', array(
				'items'    => $items,
				'pages'    => $pages,
				'category' => $category,

		));
	}
	
	public function actionPage()
	{
		if (empty($_GET['view']))
			$this->actionIndex();
		$model = Page::model()->findByUrl($_GET['view']);
		// if page is not found, then run a controller with that name
		if ($model === NULL)
			throw new CHttpException(400, 'Khong tim thay trang');
		else {
			$this->pageTitle = $model->title;
			$this->render('page', array('model' => $model));
		}
	}
	
	public function actionDetail($id)
	{
        $post=$this->loadModel($id);
        $comment=$this->newComment($post);

        $this->render('detail',array(
            'model'=>$post,
            'comment'=>$comment,
        ));
	}

//	public function actionDetailCD($id)
//	{
//		$model               = Volume::model()->findByPk($id);
//		$this->pageTitle     = $model->name;
//		$criteria            = new CDbCriteria();
//		$criteria->condition = 'status=1 AND id>' . $model->id;
//		//$criteria->limit     = 8;
//		$criteria->order     = 'id DESC';
//		$items               = Volume::model()->findAll($criteria);
//		//$info                = Page::model()->findByUrl('thongtinchitiet');
//		$time                = $model->time;
//		$info                = $model->info;
//		$this->render('detailCD', array(
//				'items' => $items,
//				'model' => $model,
//				'info'  => $info,
//				'time'  => $time,
//		));
//	}
//
//
//    public function actionDetailType($id)
//    {
//        $model               = Type::model()->findByPk($id);
//        $this->pageTitle     = $model->name;
//        $criteria            = new CDbCriteria();
//        $criteria->condition = 'voltypeId='.$model->id;
//        $criteria->limit     = 8;
//        $criteria->order     = 'id DESC';
//        $items               = Volume::model()->findAll($criteria);
//        $this->render('detailType', array(
//            'items' => $items,
//            'model' => $model,
//        ));
//    }
//
//
//	public function actionDetailPt($id)
//	{
//
//        $model               = Volume::model()->findByPk($id);
//		$this->pageTitle     = $model->name;
//      //  $model               = Patent::model()->findByPk($id);
//		$criteria            = new CDbCriteria();
//		$criteria->condition = ' volumeId=' . $model->id;
//		$criteria->limit     = 8;
//		$criteria->order     = 'id DESC';
//
//        $count = Patent::model()->count($criteria);
//        $pages = new CPagination($count);
//        //results per page
//        $pages->pageSize = 16;
//        $pages->applyLimit($criteria);
//		$items               = Patent::model()->findAll($criteria);
//		//$time                = $model->time;
//		//$info                = $model->info;
//		$this->render('detailPt',array(
//			'model'=>$model,
//            'items'=>$items,
//            'pages'=> $pages,
//            'count'=>$count,
//		));
//
//	}
	
	public function actionSearch()
	{
		$key             = isset($_REQUEST['v']) ? $_REQUEST['v'] : '';
		$this->pageTitle = 'Tim kiem: ' . $key;
		if (!empty($key)) {
			$criteria            = new CDbCriteria();
            $criteria->condition = 'title like "%' . $key . '%"';
            $criteria->order = 'id DESC';
			$count = Post::model()->count($criteria);
			$pages = new CPagination($count);
			//results per page
			$pages->pageSize = 16;
			$pages->applyLimit($criteria);
 			$items = Post::model()->findAll($criteria);
			$this->render('search', array(
                'items' => $items,
                'pages' => $pages
			));
		} else {
			throw new CHttpException(400, 'Ban phai nhap tu khoa tim kiem');
		}
}

//	public function actionCD()
//	{
//
//		$this->pageTitle = 'Danh mục Volume';
//		$criteria            = new CDbCriteria();
//		$items = Type::model()->findAll($criteria);
//		$criteria->limit     = 8;
//		$this->render('CD', array(
//				'items'    => $items,
//		));
//	}
	
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	//-----------------
//    function actionDownload($name){
//        $filecontent=file_get_contents('path_to_file'.$name);
//        header("Content-Type: text/plain");
//        header("Content-disposition: attachment; filename=$name");
//        header("Pragma: no-cache");
//        echo $filecontent;
//        exit;
//    }

    function actionDownload($filename){
        $filecontent=file_get_contents('path_to_file'.$filename);
        header("Content-type:application/pdf"); //for pdf file
        header("Content-disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        echo $filecontent;
        exit;
    }

}