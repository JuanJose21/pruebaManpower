<?php
namespace App\Controller;

class HomeController extends Controller
{
	public function index($request, $response)
	{
		return $response->withRedirect($this->router->pathFor('signin'));
	}
	
	public function crud($request, $response)
	{
		if(isset($_SESSION['user'])){
			return $this->view->render($response, 'partials/crud.twig');
		}else{
			return $response->withRedirect($this->router->pathFor('home'));
		}
	}
}
