<?php

class ThreadsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
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
		$model = $this->loadModel($id);
		$posts = Yii::app()->db->createCommand('select p.id, t.owner_id, p.author_id, u.username as author, p.content, p.create_date, p.update_date from posts p join threads t on t.id=p.thread_id join users u on u.id=p.author_id where p.thread_id='.$id.' order by p.create_date asc, id asc')->queryAll();
		$dataProvider = new CArrayDataProvider($posts);
		
		$this->render('view',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
			'tid'=>$id,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Threads;
		$postModel = new Posts;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		$this->performAjaxValidation($postModel);

		if(isset($_POST['Threads']) && isset($_POST['Posts']))
		{
			$model->attributes=$_POST['Threads'];
			$postModel->attributes=$_POST['Posts'];
			if($model->save())
			{
				$postModel->thread_id = $model->id;
				if($postModel->save())
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'postModel'=>$postModel,
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Threads']))
		{
			$model->attributes=$_POST['Threads'];
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
		//$dataProvider=new CActiveDataProvider('Threads');
		$forum = Yii::app()->db->createCommand('select id from forums where group_id='.Yii::app()->user->gid)->queryAll();
		$threads = Yii::app()->db->createCommand('select t.id, u.username as owner, t.name, (select count(*) from posts where thread_id=t.id) as posts from threads t join users u on u.id=t.owner_id where t.forum_id='.(int)$forum[0]['id'])->queryAll();
		$dataProvider = new CArrayDataProvider($threads);
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Threads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Threads']))
			$model->attributes=$_GET['Threads'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Threads::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='threads-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
