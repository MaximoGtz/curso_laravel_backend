<?php
namespace App\Business\Services;
use App\Models\User;

class UserService{
    public function __construct(protected EncryptService $encrypyService){

    }
    public function encryptEmail(int $id):string{
        $user = User::find($id);
        $encryptedEmail =  $this->encrypyService->encrypt($user->email);
        return $encryptedEmail; 
    }
}