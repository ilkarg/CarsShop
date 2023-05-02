<?php

$router->post("plus", "MainController::plus");

$router->get("test", "MainController::test");

$router->get("test123", function() { MainController::test123(); });

$router->get("/", function() { MainController::index(); });