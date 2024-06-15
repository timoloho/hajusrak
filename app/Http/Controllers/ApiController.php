<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private function lurescape($limit) {
        $response = Http::get('https://lurescape.matlikofficial.com/api/fish?limit=' . $limit);

        return $response->json();
    } 

    private function cars($limit) {
        $response = Http::get('https://hajus.tak21fredyait.itmajakas.ee/api/car?limit=' . $limit);

        return $response->json();
    } 

    private function VW($limit) {
        $response = Http::get('https://vwapi.tak21mander.itmajakas.ee/api/vw?limit=' . $limit);

        return $response->json();
    } 

    public function index() {

        $limit = request()->get('limit') ?? '';

        if ($limit == 0) {
            $limit = '';
        }

        if (request()->get('whatapi') == 'lurescape') {
            $response = $this->lurescape($limit);
        } else if (request()->get('whatapi') == 'cars'){
            $response = $this->cars($limit);
        }
        else if (request()->get('whatapi') == 'vw'){
            $response = $this->vw($limit);
        }


        return $response;
    }
}
