<?php

namespace app\controllers;

use app\models\RandomNumber;

class IndexController
{
    public function generate()
    {
        $id = (new RandomNumber())->add(rand());

        ApiResponse(201, [
            'message' => 'Generated',
            'id' => $id
        ]);
    }

    public function retrieve($id)
    {
        $number = (new RandomNumber())->get($id);
        if ($number) {
            ApiResponse(200, ['value' => $number->value]);
        } else {
            ApiResponse(404, ['message' => 'Number not found']);
        }
    }

}
