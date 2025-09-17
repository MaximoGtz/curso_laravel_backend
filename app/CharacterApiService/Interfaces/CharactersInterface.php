<?php

namespace App\CharacterApiService\Interfaces;

use Illuminate\Http\Client\Response;

interface CharactersInterface{
    public function getOneCharacter(int $id): Response;
    public function getCharacters(int $initial_id, int $totalCharacters):Response;
}