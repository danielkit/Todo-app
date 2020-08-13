<?php

namespace app\models;

use yii\db\ActiveRecord;

class Tasklist extends ActiveRecord
{

    public $id;

    public function deleteTasklistIncludingAllChildren()
    {
        $tasks = $this->getTasks();

        foreach ($tasks as $task) {
            if (!$task->delete()) {
                die('Noe gikk galt...');
            }
        }
        return $this->delete();
    }

    public function getTasks()
    {
        return Task::find()->where("tasklist_ID = '$this->ID'")->all();
    }

}
