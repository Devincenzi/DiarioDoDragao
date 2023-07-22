<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Capitulos;
use App\Models\Localizacoes;
use Illuminate\Http\Request;

class LocalizacoesController extends Controller{
    //
    public function setLocalizacoes(Request $request){
        // return response(json_encode('teste'), 200);
        // $capitulo_id = $request['capitulo_id'];
        // $parentLocal = $request['parentLocal'];

        $result = '';
        // // $capitulo = Capitulos::find($capitulo_id);

        $nome = $request['nome'];

        // if(!$capitulo_id)
            $result = Localizacoes::create(['nome'=>$nome]);

        // if($capitulo_id){
        //     $pai_local = Localizacoes::find($parentLocal);
        //     $novo_local = new Localizacao([
        //         'nome' => $nome
        //     ]);
        //     $result = $pai_local->localizacao()->save($novo_local);
        // }
        return response(json_encode($result), 200)->header('Content-type', 'application/json');
    }

    public function getLocalizacoes(Request $request){
        $parentLocal = $request['idLocalizacao'];

        $localizacoes = null;

        // return response(json_encode($parentLocal));

        if(!$parentLocal){
            $localizacoes = Localizacoes::where('localizacao_pai', '=', null)->get();

            return response(json_encode($localizacoes), 200)
                ->header('Content-type', 'application/json');
        }

        if($parentLocal != 0 || $parentLocal != null){
            $localizacoes = Localizacoes::where('localizacao_pai', '=', $parentLocal)->get();

            return response(json_encode($localizacoes), 200)
                ->header('Content-type', 'application/json');
        }
    }
}
