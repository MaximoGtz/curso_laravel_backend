<?php
use App\CharacterApiService\Interfaces\CharactersInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class RickAndMortyApiService implements CharactersInterface
{
    public function __construct(protected string $url) {}
    public function getOneCharacter(int $id): Response
    {
        $response = Http::get($this->url . "/character/" . $id);
        return $response;
    }
    public function getCharacters(int $initial_id, int $totalCharacters): Response
    {
        $initial_id = 2;
        $total_characters = 5;

        $characters_string = "";
        for ($i = $initial_id; $i < $total_characters; $i++) {
            $characters_string .= $i;
            echo $characters_string;
        }


        $response = Http::get($this->url . "/character/" . $initial_id . "," . $finalCharacter);
        return $response;
    }
}
