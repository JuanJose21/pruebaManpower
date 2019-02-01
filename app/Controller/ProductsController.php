<?php
namespace App\Controller;
use App\Models\Product;
use Illuminate\Database\Capsule\Manager as DB;
class ProductsController extends Controller
{
  public function listar($request, $response, $args)
  {
    $data = $request->getParams();

    $productos = Product::select("*")
    ->get();

    if($productos){
        echo json_encode(array("status"=>true, "data"=> $productos), JSON_UNESCAPED_UNICODE );
    }else{
        echo json_encode(array("status"=>false));
    }
  }

  public function crear($request, $response, $args)
	{
    date_default_timezone_set('America/Bogota');

    $data = $request->getParams();

    $newProduct = [
        "category_id"=> trim(strip_tags($data['category_id'])),
        "name" => trim(strip_tags($data['name'])),
        "quantity" => trim(strip_tags($data['quantity']))
    ];

    try{
        DB::beginTransaction();
        Product::insert($newProduct);
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
