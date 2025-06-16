<?php
namespace App\Business\Services;

use App\Business\Interfaces\MessageServiceInterface;

class HiService implements MessageServiceInterface{
    public function sayHi(){
        return "Hola mundo";
    }
    public function hi(){
        return "Hi world!";
    }
}