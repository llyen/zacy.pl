<?php

class GroupsController extends Controller
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
				'actions'=>array('index','applications','confirmApplication','rejectApplication','create','join','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Groups;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Groups']))
		{
			$model->attributes=$_POST['Groups'];
			if($model->save())
			{
				$sock = new HTTPSocket;
				$sock->connect(Yii::app()->params['hostURL'], 2222);
				$sock->set_login(Yii::app()->params['hostLogin'],Yii::app()->params['hostPassword']);
 
				$sock->query('/CMD_API_POP',
				array(
					'action'=>'create',
					'domain'=>Yii::app()->params['hostURL'],
					'quota'=>25,
					'passwd'=>$model->password,
					'user'=>$model->name,
			        ));
 
				$result = $sock->fetch_parsed_body();
				
				$user = Users::model()->findByPk(Yii::app()->user->id);
				$user->group_id = $model->id;
				$user->confirmed = 1;
				$forum = new Forums();
				$forum->group_id = $model->id;
				$forum->name = $model->name;
				$calendar = new Calendars();
				$calendar->group_id = $model->id;
				$storage = new Storages();
				$storage->group_id = $model->id;
				$storage->path = $model->name.'/';
				
				$path = Yii::app()->basePath.'/../storages/'.$storage->path.'/';
				if(!is_dir($path))
				{
					mkdir($path, 0755, true);
				}
				
				if($user->save() && $forum->save() && $calendar->save() && $storage->save())
				{
					Yii::app()->user->setFlash('info', '<strong>Sukces.</strong> Utworzono nową grupę.');
					$this->redirect(array('groups/index'));	
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionJoin()
	{
		//$groups = Groups::model()->find(array('select'=>'id,name'));
		//$dataProvider = new CArrayDataProvider($groups);
		$groups = Groups::model()->findAll();
		$dataProvider = array();
		foreach($groups as $g)
			$dataProvider[] = $g->name;
		
		$model = Users::model()->findByPk(Yii::app()->user->id);
		
		if($_POST && $_POST['group_id']!='')
		{
			foreach($groups as $g)
				$dataProvider[$g->name] = $g->id;
			//$model = Users::model()->findByPk(Yii::app()->user->id);
			$model->group_id = $dataProvider[$_POST['group_id']];
			if($model->save())
			{
				Yii::app()->user->setFlash('info', '<strong>Sukces.</strong> Twoja prośba o dołączenie do wybranej grupy oczekuje na akceptację jej administratora.');
				$this->redirect(array('groups/index'));
			}
		}
		
		$this->render('join', array(
			'dataProvider' => $dataProvider,
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

		if(isset($_POST['Groups']))
		{
			$model->attributes=$_POST['Groups'];
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
		//$members = Users::model()->findByAttributes(array('group_id' => Yii::app()->user->gid));
		//$dataProvider=new CActiveDataProvider('Groups');
		if(Yii::app()->user->gid !== null)
		{
			$members = Yii::app()->db->createCommand('select id,username from users where confirmed=1 and group_id='.Yii::app()->user->gid)->queryAll();
			$dataProvider = new CArrayDataProvider($members);
		}
		else
		{
			$dataProvider = '';	
		}
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionApplications()
	{
		if(Yii::app()->user->isGroupAdmin())
		{
			$members = Yii::app()->db->createCommand('select id, username from users where confirmed=0 and group_id='.Yii::app()->user->gid)->queryAll();
			$dataProvider = new CArrayDataProvider($members);
			$this->render('applications',array(
				'dataProvider'=>$dataProvider,
			));
		}
		else
		{
			Yii::app()->user->setFlash('error', '<strong>Błąd!</strong> Nie masz uprawnień do korzystania z tej funkcji.');
			$this->redirect(array('groups/index'));
		}
	}
	
	public function actionConfirmApplication($uid)
	{
		if(Yii::app()->user->isGroupAdmin())
		{
			$member = Users::model()->findByPk($uid);
			$member->confirmed = 1;
			if($member->save())
			{
				Yii::app()->user->setFlash('success', '<strong>Sukces.</strong> Zgłoszenie zostało zaakceptowane.');
			}
			else
			{
				Yii::app()->user->setFlash('error', '<strong>Błąd!</strong> Brak zgłoszenia dla użytkownika o podanym ID.');
			}
			$this->redirect(array('groups/index'));
		}
		else
		{
			Yii::app()->user->setFlash('error', '<strong>Błąd!</strong> Nie masz uprawnień do korzystania z tej funkcji.');
			$this->redirect(array('groups/index'));
		}
	}
	
	public function actionRejectApplication($uid)
	{
		if(Yii::app()->user->isGroupAdmin())
		{
			$member = Users::model()->findByPk($uid);
			$member->group_id = null;
			if($member->save())
			{
				Yii::app()->user->setFlash('warning', '<strong>Uwaga!</strong> Zgłoszenie zostało odrzucone.');
			}
			else
			{
				Yii::app()->user->setFlash('error', '<strong>Błąd!</strong> Brak zgłoszenia dla użytkownika o podanym ID.');
			}
			$this->redirect(array('groups/index'));
		}
		else
		{
			Yii::app()->user->setFlash('error', '<strong>Błąd!</strong> Nie masz uprawnień do korzystania z tej funkcji.');
			$this->redirect(array('groups/index'));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Groups('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Groups']))
			$model->attributes=$_GET['Groups'];

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
		$model=Groups::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='groups-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
