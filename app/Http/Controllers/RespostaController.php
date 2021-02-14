<?php

namespace App\Http\Controllers;

use App\Models\Resposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RespostaController extends Controller
{
    public function receber_respostas(Request $request)
    {
        $request->validate([
            'pergunta_id' => 'required',
        ]);
        $pergunta_id = $request->pergunta_id;

        $dados = Resposta::select("resposta")->where("pergunta_id", $pergunta_id)->get();
        if(count($dados)>0){
            return response()->json([
                "res" => $dados
            ]);
        } else {
            return response()->json([
                "res" => "Ninguém respondeu ainda :("
            ]);
        }
    }


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
}
