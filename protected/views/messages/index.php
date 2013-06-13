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
<h3>Grupa #<?php echo $mailbox['name']; ?> - Odebrane wiadomości</h3>
<?php

if($mbox = @imap_open("{".Yii::app()->params['hostURL'].":".Yii::app()->params['hostPort']."/pop3/novalidate-cert}INBOX", $mailbox['name'].'@'.Yii::app()->params['hostURL'], $mailbox['pass'], OP_SILENT))
{
	$MC = imap_check($mbox);

	if($MC->Nmsgs>0)
	{
		$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
		echo '<table class="span7 fix">
		<thead>
			<tr>
				<th style="width: 200px;">Od</th>
				<th style="width: 300px;">Temat</th>
				<th style="width: 100px;">Otrzymano</th>
				<th style="width: 70px;">Opcje</th>
			</tr>
			</thead>
			<tbody>';
		foreach ($result as $overview)
		{
		    echo '<tr><td>'.$overview->from.'</td><td>'.imap_utf8($overview->subject).'</td><td>'.date('Y.m.d', strtotime($overview->date)).'</td><td><a href="'.Yii::app()->createUrl('messages/view', array('msgno'=>$overview->msgno)).'"><img alt="szczegóły" src="'.Yii::app()->baseUrl.'/images/details.png"></a></td></tr>';
		    //echo "<tr>#{$overview->msgno} ({$overview->date}) - Od: {$overview->from} - Temat: {$overview->subject}</tr>";
		    //var_dump($overview);
		}
		echo '</tbody></table>';	
	}
	
	@imap_close($mbox);
}
else
{
	var_dump(imap_errors());
}

?>