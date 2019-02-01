<?php
namespace App\Controller;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;

class ApiController extends Controller
{
	public function registerUser($request, $response, $args)
	{
    date_default_timezone_set('America/Bogota');

    $data = $request->getParams();

    $newUser = [
        "username"=> trim(strip_tags($data['username'])),
        "email" => trim(strip_tags($data['email'])),
        "password" => trim(strip_tags(password_hash($data['password'],PASSWORD_DEFAULT)))
    ];

    try{
        DB::beginTransaction();
        User::insert($newUser);
        DB::commit();
        $res = array('status' => true);

    }catch (\Illuminate\Database\QueryException $ex){
        DB::rollback();
        $res = array('status'=> false,"message"=>"Ocurro un error...", "codError" => $ex->errorInfo[1], "error" => "Se presentó un error", "error_db" => $ex->getMessage());
    }

    return $response->withStatus(200)
    ->withHeader('Content-type', 'application/json')
    ->withJson($res);
	}
}
