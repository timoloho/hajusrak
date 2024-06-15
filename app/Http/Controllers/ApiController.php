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

    private function Disc($limit) {
        $response = Http::get('https://api.tak21loho.itmajakas.ee/api/disc?limit=' . $limit);

        return $response->json();
    }

    public function index() {

        $limit = request()->get('limit') ?? '';

        if ($limit == 0) {
            $limit = '';
        }

        if (request()->get('whatapi') == 'lurescape') {
            $response = $this->lurescape($limit);
        } 
        else if (request()->get('whatapi') == 'cars'){
            $response = $this->cars($limit);
        }
        else if (request()->get('whatapi') == 'disc'){
            $response = $this->disc($limit);
        }


        return $response;
    }
}
