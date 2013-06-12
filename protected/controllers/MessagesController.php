<?php

class MessagesController extends Controller
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
				'actions'=>array('index','view','downloadAttachment'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$group = Groups::model()->findByPk(Yii::app()->user->gid);
		
		//$mailbox = array();
		$mailbox['name'] = $group->name;
		$mailbox['pass'] = $group->password;
		
		$this->render('index', array(
				'mailbox' => $mailbox,
			));
	}
	
	public function actionView($msgno=null)
	{
		if($msgno !== null)
		{
			$group = Groups::model()->findByPk(Yii::app()->user->gid);
		
			$mailbox['name'] = $group->name;
			$mailbox['pass'] = $group->password;
			
			$this->render('view', array(
					'msgno' => $msgno,
					'mailbox' => $mailbox,
				));
		}
		else
		{
			$this->redirect('index');
		}
	}
	
	public function actionDownloadAttachment($msgno, $partno)
	{
		$group = Groups::model()->findByPk(Yii::app()->user->gid);
		if($mbox = @imap_open("{".Yii::app()->params['hostURL'].":".Yii::app()->params['hostPort']."/pop3/novalidate-cert}INBOX", $group->name.'@'.Yii::app()->params['hostURL'], $group->password, OP_SILENT))
		{
			$structure = imap_fetchstructure($mbox, $msgno);

			$encoding = $structure->parts[$partno]->encoding;
			//extract file name from headers
			$fileName = imap_mime_header_decode(strtolower($structure->parts[$partno]->dparameters[0]->value))[0]->text;
			//extract attachment from email body
			$fileSource = base64_decode(imap_fetchbody($mbox, $msgno, $partno+1));
			
			//get extension
			$ext = substr($fileName, strrpos($fileName, '.') + 1);
			//die($ext);
	
			//get mime file type
			switch ($ext) {
			case "asf":
				$type = "video/x-ms-asf";
				break;
			case "avi":
				$type = "video/avi";
				break;
			case "flv":
				$type = "video/x-flv";
				break;
			case "fla":
				$type = "application/octet-stream";
				break;
			case "swf":
				$type = "application/x-shockwave-flash";
				break;		
			case "doc":
				$type = "application/msword";
				break;
			case "docx":
				$type = "application/msword";
				break;
			case "zip":
				$type = "application/zip";
				break;
			case "xls":
				$type = "application/vnd.ms-excel";
				break;
			case "gif":
				$type = "image/gif";
				break;
			case "jpg" || "jpeg":
				$type = "image/jpg";
				break;
			case "png":
				$type = "image/png";
				break;		
			case "wav":
				$type = "audio/wav";
				break;
			case "mp3":
				$type = "audio/mpeg3";
				break;
			case "mpg" || "mpeg":
				$type = "video/mpeg";
				break;
			case "rtf":
				$type = "application/rtf";
				break;
			case "htm" || "html":
				$type = "text/html";
				break;
			case "xml":
				$type = "text/xml";
				break;	
			case "xsl":
				$type = "text/xsl";
				break;
			case "css":
				$type = "text/css";
				break;
			case "php":
				$type = "text/php";
				break;
			case "txt":
				$type = "text/txt";
				break;
			case "asp":
				$type = "text/asp";
				break;
			case "pdf":
				$type = "application/pdf";
				break;
			case "psd":
				$type = "application/octet-stream";
				break;
			default:
				$type = "application/octet-stream";
			}
			@imap_close($mbox);
			
			header('Content-Description: File Transfer');
			header('Content-Type: '.$type);
			header('Content-Disposition: attachment; filename='.basename($fileName));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			//header('Content-Length: ' . filesize($fileSource));
			ob_clean();
			flush();
			echo $fileSource;
			
			//$request = new CHttpRequest();
			//if(file_put_contents(Yii::app()->basePath.'/../attachments/'.$fileName, $fileSource))
			//{
			//	header('Content-Description: File Transfer');
			//	header('Content-Type: '.$type);
			//	header('Content-Disposition: attachment; filename='.basename($fileName));
			//	header('Content-Transfer-Encoding: binary');
			//	header('Expires: 0');
			//	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			//	header('Pragma: public');
			//	header('Content-Length: ' . filesize(Yii::app()->basePath.'/../attachments/'.$fileName));
			//	ob_clean();
			//	flush();
			//	readfile(Yii::app()->basePath.'/../attachments/'.$fileName);
			//}
		}
		else
		{
			var_dump(imap_errors());
		}
	}

}