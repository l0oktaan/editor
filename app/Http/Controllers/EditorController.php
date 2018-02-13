<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editor;

class EditorController extends Controller
{
    public function index()
    {
        return view('editor.index');
    }

    public function getData()
    {
        $model = Editor::searchPaginateAndOrder();
        $model->load('depart','user');
        
        $columns = Editor::$columns;

        return response()
            ->json([
                'model' => $model,
                'columns' => $columns
            ]);
    }
}
