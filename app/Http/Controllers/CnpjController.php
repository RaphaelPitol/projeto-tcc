<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CnpjController extends Controller
{
    public function buscarCnpj($cnpj)
    {
        // $client = new Client();
        // $response = $client->request('GET', "https://receitaws.com.br/v1/cnpj/{$cnpj}", ['verify' => false]);
        // $dados = json_decode( $response->getBody()->getContents(), true);

        $response = Http::withOptions(['verify' => false])->get("https://receitaws.com.br/v1/cnpj/{$cnpj}");
        if ( $response) {
            return $response;
        }

        return response()->json(['error' => 'Erro ao buscar CNPJ'], 500);
    }
}
