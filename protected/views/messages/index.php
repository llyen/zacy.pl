<?php
/* @var $this MessagesController */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
	array('label'=>'WIADOMOŚCI'),
	array('label'=>'Odebrane', 'url'=>array('messages/index'), 'active'=>true, 'icon'=>'envelope'),	
	);
?>
<h3>grupa test - odebrane wiadomości</h3>
<?php

if($mbox = @imap_open("{e-zacy.pl:110/pop3/novalidate-cert}INBOX", 'test@e-zacy.pl', 'test', OP_SILENT))
{
	$MC = imap_check($mbox);

	$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
	foreach ($result as $overview)
	{
	    echo "#{$overview->msgno} ({$overview->date}) - Od: {$overview->from} - Temat: {$overview->subject}\n<br>";
	}
	@imap_close($mbox);
}
else
{
	var_dump(imap_errors());
}

?>