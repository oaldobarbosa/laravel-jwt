<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login( Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $auth = $this->loginService->execute( $credentials );

            return response()->json($auth, 200);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function me()
    {
        try {
            return response()->json(auth()->user(), 200);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function logout()
    {
        try {
            auth()->logout(true);
            //return response()->json(auth()->user(), 200);
        } catch (Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage()], $ex->getCode());
        }
    }
}
