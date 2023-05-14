<?php

use PHPSystem\System;
use PHPHash\Hash;

class QueryController {
	public static function loginQuery(string $login, string $password) {
        session_start();
        if (isset($_SESSION["user"])) {
            return json_encode(array("response" => "Вы уже находитесь в аккаунте"));
        }
        global $orm;
        $orm->connect();
        $user = R::find("users", "login = ? AND password = ?", [$login, Hash::sha256($password, "", 1)]);
        $user = $user[array_key_first($user)];
        if ($user == null) {
            return json_encode(array("response" => "Неверные логин или пароль"));
        }
        $_SESSION["user"] = $user;
        return json_encode(array("response" => "Вы успешно вошли в аккаунт"));
    } 

    public static function registrationQuery(string $login, string $password) {
        session_start();
        if (isset($_SESSION["user"])) {
            return json_encode(array("response" => "Вы уже находитесь в аккаунте"));
        }
        global $orm;
        $orm->connect();
        $user = R::dispense("users");
        $user->login = $login;
        $user->password = Hash::sha256($password, "", 1);
        try {
            R::store($user);
            $_SESSION["user"] = $user;
        } catch (RedBeanPHP\RedException\SQL $except) {
            if (System::startsWith($except->getMessage(), "SQLSTATE[23000]: Integrity constraint violation")) {
                return json_encode(array("response" => "User already exists"));
            }
        }
        return json_encode(array("response" => "OK"));
    }

    public static function addPostQuery(string $title, string $body, string $image) {
        global $orm;
        $orm->connect();
        $post = R::dispense("posts");
        $post->title = $title;
        $post->body = $body;
        $post->image = $image;
        R::store($post);
        return json_encode(array("response" => "Пост успешно создан"));
    }

    public static function getAllPostsQuery() {
        global $orm;
        $orm->connect();
        $posts = R::findAll("posts");
        if ($posts == null) {
            return json_encode(array("response" => "Посты не найдены"));
        }
        return json_encode($posts);
    }

    public static function getPostByIdQuery(int $id) {
        global $orm;
        $orm->connect();
        $post = R::find("posts", "id = ?", [$id]);
        if ($post == null) {
            return json_encode(array("response" => "Указанный пост не найден"));
        }
        return json_encode($post);
    }

    public static function getLastPostIdQuery() {
        global $orm;
        $orm->connect();
        $post = R::findLast("posts");
        return json_encode(array("id" => $post->id));
    }

    public static function addFeedbackQuery(string $fio, string $email, string $message) {
        global $orm;
        $orm->connect();
        $feedback = R::dispense("feedbacks");
        $feedback->fio = $fio;
        $feedback->email = $email;
        $feedback->message = $message;
        R::store($feedback);
        return json_encode(array("response" => "Обращение успешно отправлено"));
    }

    public static function getAllFeedbacksQuery() {
        global $orm;
        $orm->connect();
        $feedbacks = R::findAll("feedbacks");
        if ($feedbacks == null) {
            return json_encode(array("response" => "Feedbacks not found"));
        }
        return json_encode($feedbacks);
    }

    public static function createOrderQuery(string $name, string $email, string $phone, string $model, string $price) {
        global $orm;
        $orm->connect();
        $order = R::dispense("orders");
        $order->name = $name;
        $order->email = $email;
        $order->phone = $phone;
        $order->model = $model;
        $order->price = $price;
        R::store($order);
        return json_encode(array("response" => "Бронь успешно создана"));
    }

    public static function getAllOrdersQuery() {
        global $orm;
        $orm->connect();
        $orders = R::findAll("orders");
        if ($orders == null) {
            return json_encode(array("response" => "Orders not found"));
        }
        return json_encode($orders);
    }
}