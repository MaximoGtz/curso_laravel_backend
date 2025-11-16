<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CesarController extends Controller
{
    
    // Método para encriptar
    public function encrypt($data, $shift = 3)
    {
        return response()->json([
            // 'original' => $data,
            'encrypted' => $this->cesarCipher($data, $shift),
            // 'shift' => $shift
        ]);
    }

    // Método para desencriptar
    public function decrypt($data, $shift = 3)
    {
        return response()->json([
            // 'encrypted' => $data,
            'decrypted' => $this->cesarCipher($data, -$shift),
            // 'shift' => $shift
        ]);
    }


    // Función interna de cifrado César
    private function cesarCipher($text, $shift)
    {
        $result = "";

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            // Si es letra mayúscula A-Z
            if (ctype_upper($char)) {
                $result .= chr(((ord($char) - 65 + $shift) % 26 + 26) % 26 + 65);
            }
            // Si es letra minúscula a-z
            elseif (ctype_lower($char)) {
                $result .= chr(((ord($char) - 97 + $shift) % 26 + 26) % 26 + 97);
            }
            // Si no es letra, lo deja igual
            else {
                $result .= $char;
            }
        }

        return $result;
    }
}
