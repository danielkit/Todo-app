<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller {

    public function actionIndex() {

        // http://192.168.33.10/index.php?r=country - country = CountryController
        // CountryController laster inn view 'index' fra views/country/index.php

        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

            $countries = $query->orderBy(['population' => SORT_ASC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);

    }
}
