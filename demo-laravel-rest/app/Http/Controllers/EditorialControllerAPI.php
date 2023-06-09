<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EditorialControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $editoriales = DB::table('editoriales')->get();
        return $editoriales;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $editorial = [
            'codigo_editorial' => $request->codigo_editorial,
            'nombre_editorial' => $request->nombre_editorial,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono
        ];

        return DB::insert('INSERT INTO editoriales VALUES(:codigo_editorial, :nombre_editorial,
         :contacto, :telefono)', $editorial);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $editorial = DB::table('editoriales')->where('codigo_editorial', $id)->first();
        return $editorial;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id)
    {
        //
        $editorial = [
            'codigo_editorial' => $id,
            'nombre_editorial' => $request->nombre_editorial,
            'contacto' => $request->contacto,
            'telefono' => $request->telefono
        ];
        DB::update('UPDATE editoriales SET nombre_editorial = :nombre_editorial,contacto = :contacto, telefono = :telefono WHERE codigo_editorial = :codigo_editorial', $editorial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::delete('DELETE FROM editoriales WHERE codigo_editorial = :codigo_editorial', ['codigo_editorial' => $id]);
    }
}
?>