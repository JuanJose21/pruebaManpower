<?php
namespace App\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function listar($request, $response, $args)
    {
      $data = $request->getParams();

      $categorias = Category::select("*");
      ->get();

      if($categorias){
          echo json_encode(array("status"=>true, "data"=> $categorias), JSON_UNESCAPED_UNICODE );
      }else{
          echo json_encode(array("status"=>false));
      }
    }
}
