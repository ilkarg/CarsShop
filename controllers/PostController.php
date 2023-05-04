<?php

include __DIR__ . "/../models/Post.php";

class PostController {
	public static function addPost() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            if (!is_dir(__DIR__ . "/../pages/post_images/")) {
                mkdir(__DIR__ . "/../pages/post_images/");
            }
            copy($_FILES["image"]["tmp_name"], __DIR__ . "/../pages/post_images/" . $_FILES["image"]["name"]);
            $post_model = new Post($data["title"], $data["body"], "/pages/post_images/" . $_FILES["image"]["name"]);
            $post = QueryController::addPostQuery(
                $post_model->title, 
                $post_model->body,
                $post_model->image
            );
            echo $post;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getPostById() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $post = QueryController::getPostByIdQuery($data["id"]);
            echo $post;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

	public static function getAllPosts() {
        $posts = QueryController::getAllPostsQuery();
        echo $posts;
    }

    public static function getLastPostId() {
        $id = QueryController::getLastPostIdQuery();
        echo $id;
    }
}