<?php
namespace App\Controller;
use App\Models\Product;

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
}
