<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorialesController extends Controller
{
    public function index(){
        return view('editoriales.index');
    }

    public function create(){
        return view('editoriales.create');
    }

    public function edit($id){
        $datos=['id'=>$id,
                'nombre'=>'Clasicos Roxy'];
        return view('editoriales.edit',$datos);
    }
}
