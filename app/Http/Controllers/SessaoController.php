<?php

namespace App\Http\Controllers;

use App\Models\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessaoController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'codigo' => 'required|string'
        ]);
        
        $codigo = $request->codigo;
        $dados = DB::table('sessaos')->where('codigo', $codigo)->first();
        if(isset($dados)) {
            $token = bin2hex(random_bytes(64));
            return response()->json([
                'token' => $token,
                'sessao_id' => $dados->id
            ]);
        } else {
            return response()->json([
                'Código inválido'
            ],400);
        }
    }
    public function index(){

    }
    public function create(){

    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
        ]);

        $codigo = strtoupper(bin2hex(random_bytes(4)));
        $user_id = auth('api')->user()->id;
        
        $dados = new Sessao([
            'nome' => $request->nome,
            'codigo' => $codigo,
            'user_id' => $user_id,
        ]);
        $dados->save();
        return response()->json([
            'codigo' => $codigo,
            'res' => 'Sua sessão foi cadastrada com sucesso!'
        ], 201);
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
