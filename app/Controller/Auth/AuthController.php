<?php
namespace App\Controller\Auth;
use App\Controller\Controller;
use App\Models\User;

class AuthController extends Controller
{
	public function signin($request, $response)
	{
		if(isset($_SESSION['user'])){
			return $response->withRedirect($this->router->pathFor('crud'));
		}else{
			return $this->view->render($response, 'auth/layout.twig');
		}
	}

	public function postSignin($request, $response)
	{
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);

		if($auth){
			return $response->withRedirect($this->router->pathFor('home'));
		}else{
			$this->flash->addMessage('error','Usuario y contraseña equivocados, por favor verifique.');
			return $response->withRedirect($this->router->pathFor('signin'));
		}
	}

	public function logout($request, $response)
	{
		$_SESSION = array();
		session_destroy();
		return $response->withRedirect($this->router->pathFor('signin'));
	}
}
