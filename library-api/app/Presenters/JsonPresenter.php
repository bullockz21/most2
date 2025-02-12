<?php
// app/Presenters/JsonPresenter.php
namespace App\Presenters;

class JsonPresenter
{
    public function present($data)
    {
        return response()->json($data);
    }
}
