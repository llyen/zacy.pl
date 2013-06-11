<?php

class WebUser extends CWebUser
{
    private $_model;
    
    public function getGid()
    {
        $user = $this->loadModel(Yii::app()->user->id);
        return $user->group_id;
    }

    protected function loadModel($id=null)
    {
        if($this->_model === null)
        {
            if($id !== null)
            {
                $this->_model = Users::model()->findByPk($id);
            }
        }
        return $this->_model;
    }

}