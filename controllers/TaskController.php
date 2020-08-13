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
                'tasklists' => $query // $tasklists = $query->orderBy(['ID' => SORT_ASC])->all();
            ]);
    }

    public function actionDelete($id)
    {
        $task = Task::findOne($id);                 // henter ut task.
        return json_encode($task->delete());        // sletter valgt task fra databasen.
    }

    public function actionMove($id, $tasklist_id)
    {
        $task = Task::findOne($id);                 // henter ut task.
        $task->tasklist_ID = $tasklist_id;          // henter ut tasklist_ID, og setter ny verdi på tasklist_ID'en til hva ID'en i list_id er.
        return json_encode($task->update());        // oppdaterer databasen.
    }

    public function actionEdit($id, $description)
    {
        $task = Task::findOne($id);                 // henter task.
        $task->description = $description;          // overskriver gammel beskrivelse til ny beskrivelse.
        return json_encode($task->update());        // oppdaterer raden i databasen.
    }

    public function actionAdd($description, $tasklist_ID)
    {
        $task = new Task;                           // instansierer en ny task ved bruk av klassene Task og ActiveRecord
        $task->description = $description;          // task->description blir verdien til $description
        $task->tasklist_ID = $tasklist_ID;          // task->tasklist_ID blir verdien til $tasklist_ID
        return json_encode($task->insert());        // det samme som INSERT INTO task VALUES ('...','...','...');
    }

    public function actionDeletetasklist($id)
    {
        $tasklist = Tasklist::findOne($id);                                     // henter ut tasklist med valgt ID.
        return json_encode($tasklist->deleteTasklistIncludingAllChildren());    // sletter valgt tasklist og alle tasks med
    }                                                                           // samme id som tasklisten som slettes

    public function actionAddtasklist($title)
    {
        $tasklist = new Tasklist;                   // instansierer en ny taskliste ved bruk av klassene Tasklist og ActiveRecord
        $tasklist->title = $title;                  // tasklist->title er lik verdien til $title
        return json_encode($tasklist->insert());    // det samme som INSERT INTO tasklist VALUES ('...','...');
    }

}

// http://192.168.33.10/index.php?r=country
// r=country. country = CountryController */
// CountryController laster inn view index fra views/country/(index.php) */

// http://192.168.33.10/index.php?r=country/delete */
// r=country. country = CountryController. delete refererer til actionDelete */
// CountryController laster inn view index fra views/country/(index.php) */
