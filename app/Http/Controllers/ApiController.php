<?php

namespace App\Http\Controllers;

use App\ExternalService\ApiService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //  Antes de php 8 se hacía así pero ya cambió y lo podemos hacer mejor

    // protected ApiService $apiService;
    // public function __construct(ApiService $apiService){
    //     $this->apiService = $apiService;
    // }
    public function __construct(protected ApiService $apiService){

    }
    public function get(){
        $data = $this->apiService->getData();
        return $data;
    }
}
