<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerguntaController extends Controller{
    public function index(Request $request){
        $sessao_id = $request->sessao_id;
        $dados = DB::table('perguntas')->where('sessao_id', $sessao_id);
        if(isset($dados)) {
            return response()->json(json_encode($dados), 200);
        } else {
            return response()->json([
                'res' => 'Nenhuma pergunta encontrada!'
            ], 401);
        }
    }

    public function create()
    {
        //
    }
    public function store(Request $request){
        $request->validate([
            'enunciado' => 'required|string',
            'tipo' => 'required|string',
            'quantidade' => 'required',
            'sessao_id' => 'required'
        ]);

        $dados = new Pergunta([
            'enunciado' => $request->enunciado,
            'tipo' => $request->tipo,
            'quantidade' => $request->quantidade,
            'sessao_id' => $request->sessao_id
        ]);

        $dados->save();

        return response()->json([
            'res' => 'Pergunta foi cadastrada com sucesso!'
        ],201);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
