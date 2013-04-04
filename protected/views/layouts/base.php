<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="author" content="Jakub Wawrzyniak [jakub@itpeople.pl]">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
        ?>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header" class="span9 wrapper">
		<div id="logo"><img alt="<?php echo Yii::app()->name; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/logotype.png"></div>
	</div><!-- header -->

	<div id="menu">
	
	</div><!-- menu -->
	
	<div id="content-container" class="span9 wrapper">
		<div id="content">
			<?php echo $content; ?>
		</div>
	</div><!-- content -->

</div><!-- page -->

</body>
</html>
