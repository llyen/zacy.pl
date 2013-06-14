<?php
/* @var $this ThreadsController */
/* @var $data Threads */
?>

<div class="post <?php if((int)$data['owner_id'] === (int)$data['author_id']) echo 'owner'; ?>">
    <p><?php echo $data['content']; ?></p>
    <br>
    <br>
    <?php
        if((int)$data['author_id']===(int)Yii::app()->user->id)
        {
            $this->widget('bootstrap.widgets.TbButton',array(
                    'label' => 'Edytuj',
                    'type' => 'primary',
                    'size' => 'mini',
                    'url' => Yii::app()->createUrl('posts/update', array('id'=>$data['id'])),
                    'htmlOptions'=>array(
                        'style'=>'margin-bottom: 0;',  
                    ),
                ));
        }
    ?>
    <span><strong>Autor:</strong> <em><?php echo $data['author']; ?></em> | <strong>Ostatnia modyfikacja:</strong> <?php echo $data['update_date']; ?></span>
    <span style="clear: both;"></span>
</div>