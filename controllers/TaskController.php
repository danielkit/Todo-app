<?php

namespace app\controllers;

use app\models\Tasklist;
use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{

    public function actionIndex()
    {
        $query = Tasklist::find()->all();
        return $this->render('index',
            [
                'tasklists' => $query
            ]);
    }

    public function actionDelete($id)
    {
        $task = Task::findOne($id);
        return json_encode($task->delete());
    }

    public function actionMove($id, $tasklist_id)
    {
        $task = Task::findOne($id);
        $task->tasklist_ID = $tasklist_id;
        return json_encode($task->update());
    }

    public function actionEdit($id, $description)
    {
        $task = Task::findOne($id);
        $task->description = $description;
        return json_encode($task->update());

    public function actionAdd($description, $tasklist_ID)
    {
        $task = new Task;
        $task->description = $description;
        $task->tasklist_ID = $tasklist_ID;
        return json_encode($task->insert());

    public function actionDeletetasklist($id)
    {
        $tasklist = Tasklist::findOne($id);
        return json_encode($tasklist->deleteTasklistIncludingAllChildren());
    }
        
    public function actionAddtasklist($title)
    {
        $tasklist = new Tasklist;
        $tasklist->title = $title;
        return json_encode($tasklist->insert());
    }

}
