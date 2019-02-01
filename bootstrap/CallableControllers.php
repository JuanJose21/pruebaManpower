<?php

$container["ApiController"] = function($container) {
return new \App\Controller\ ApiController($container);
 };
$container["CategoryController"] = function($container) {
return new \App\Controller\ CategoryController($container);
 };
$container["ChatController"] = function($container) {
return new \App\Controller\ ChatController($container);
 };
$container["HomeController"] = function($container) {
return new \App\Controller\ HomeController($container);
 };
$container["ProductsController"] = function($container) {
return new \App\Controller\ ProductsController($container);
 };