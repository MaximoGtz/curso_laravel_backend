<?php

namespace App\Http\Controllers;
// espacio del commit ""
use App\Business\Services\EncryptService;
use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
// cesar controller
class AuthController extends Controller
{
    public function __construct(protected EncryptService $encryptService) {
    }
    public function register(UserRequest $request ){
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData["name"],
            'email' => $validatedData["email"],
            'password' => bcrypt($validatedData["password"]),
            'role' => $validatedData["role"]
        ]);

        event(new UserRegistered($user));
        
        return response()->json([
            "message" => "Usuario registrado correctamente"
        ],Response::HTTP_CREATED);
    }
    public function login(LoginRequest $request){
        $validatedData = $request->validated();
        $credentials = [
            'email' => $validatedData["email"],
            'password' => $validatedData["password"]
        ];
        try {
            // esta intentando generar el token en el mismo condicional
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(["error" => "Usuario o contraseña no válida,"], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(["message" => "No se pudo generar el token."], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->respondWithToken($token);
    }
    public function respondWithToken($token){
        return response()->json([
            "token" => $token,
            "token_type" => 'bearer',
            "expires_in" => auth()->factory()->getTTL()
        ]);
    }
    public function who(){
        $user = auth()->user();
        return response()->json($user);
    }
    public function logout(){
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return response()->json(["message" => "Cierre de sesión correcto"], Response::HTTP_CONTINUE);
        } catch (JWTException $e) {
            return response()->json(["error" => "No se pudo cerrar la sesión, token no válido."], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 
    public function refresh(){
        try {
            $token = JWTAuth::getToken();    
            $newToken = auth()->refresh();
            JWTAuth::invalidate($token);
            return $this->respondWithToken($newToken);

        } catch (JWTException $e) {
            return response()->json(["error" => "Error al refrescar el token.", "respuesta" => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}