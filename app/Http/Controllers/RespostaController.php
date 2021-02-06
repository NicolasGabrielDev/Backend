<?php

namespace App\Http\Controllers;

use App\Models\Resposta;
use App\Models\Sessao;
use Illuminate\Http\Request;

class RespostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

    public function admin_respostas(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
        ]);

        $codigo = $request->codigo;

        $dados = Sessao::with('perguntas')->with('respostas')->where('codigo', $codigo)->get();
        return response()->json($dados);
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'resposta' => 'required|string',
            'pergunta_id' => 'required',
        ]);

        $user_id = auth('api')->user()->id;

        $dados = Resposta::where('user_id', $user_id)->where('pergunta_id', $request->pergunta_id)->first();
        if (isset($dados)) {
            return response()->json([
                'res' => "Você já respondeu essa pergunta!"
            ], 400);
        } else {
            $dados = new Resposta([
                'resposta' => $request->resposta,
                'pergunta_id' => $request->pergunta_id,
                'user_id' => $user_id
            ]);;

            $dados->save();
            return response()->json([
                'res' => "Resposta enviada com sucesso!"
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
