<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta name="author" content="Jakub Wawrzyniak [jakub@itpeople.pl]">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');
        ?>
</head>

<body>

<div class="container-fluid" id="page">

	<div id="header" class="span9 wrapper">
		<div id="logo"><img alt="<?php echo Yii::app()->name; ?>" src="<?php echo Yii::app()->baseUrl; ?>/images/logotype.png"></div>
		
		<div id="splash" class="span9 wrapper">
			<div id="about">
				<h1>Organizacja komunikacji w grupie</h1>
				<p>Poznaj narzędzia, dzięki którym wymiana informacji w Twojej grupie będzie nie tylko sprawniejsza, ale również bardziej wiarygodna.</p>
			</div>
			<div id="carousel">
					
			</div>
		</div><!-- splash -->
		
	</div><!-- header -->

	<div id="menu">
	
	</div><!-- menu -->
	
	
	
	<div id="middle"></div><!-- middle -->
	
	<div id="content-container">
		<div id="content" class="span9 wrapper">
			<?php echo $content; ?>
		</div>
	</div><!-- content -->

</div><!-- page -->

</body>
</html>
