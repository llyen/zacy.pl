<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/base'); ?>

<div id="sidebar" class="span2 fix">
	<?php
		$this->widget('bootstrap.widgets.TbMenu', array(
			'type'=>'list',
                        'stacked'=>true,
                        'items'=>$this->menu,
		));
	?>
</div>
<div id="content-body" class="span7 fix">
	<?php echo $content; ?>
</div>
<div id="content-footer"></div>
<?php $this->endContent(); ?>