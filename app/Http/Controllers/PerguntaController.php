<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Models\Sessao;
use Illuminate\Http\Request;

class PerguntaController extends Controller{
    public function index(Request $request){
        $codigo = $request->codigo;
        $user_id = auth('api')->user()->id;

        $admin = Sessao::with('perguntas')->where('codigo', '=', $codigo)->where('user_id', '=', $user_id)->first();

        if(isset($admin)) {
            return response()->json([
                'res' => $admin,
                'usuario' => 'admin'
            ]);
        } else {
            $dados = Sessao::with('perguntas')->where('codigo', '=', $codigo)->first();
            return response()->json([
                'res' => $dados,
                'usuario' => 'comum'
            ]);
        }
    }

    public function create()
    {
        //
    }
    public function store(Request $request){
        $request->validate([
            'tipo' => 'required|string',
            'quantidade' => 'required',
            'sessao_id' => 'required'
        ]);

        $dados = new Pergunta([
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
