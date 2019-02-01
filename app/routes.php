<?php
use App\Middleware\AuthMiddleware;

$app->group('', function() use ($app) {
	$app->get('/', 'HomeController:index')->setName('home');
	$app->get('/crud', 'HomeController:crud')->setName('crud');
});

$app->group('/api', function() use ($app) {
		$app->post('/registerUser', 'ApiController:registerUser');

		$app->group('/productos', function() use ($app) {
			$app->get('/listar', 'ProductsController:listar');
			$app->post('/crear', 'ProductsController:crear');
		});

		$app->group('/categoria', function() use ($app) {
			$app->get('/listar', 'CategoryController:listar');
		});
});

$app->group('/auth', function() use ($app) {
	$app->get('', 'AuthController:signin')->setName('signin');
	$app->get('/logout', 'AuthController:logout');
	$app->post('', 'AuthController:postSignin');
})->add($container->get('csrf'));
