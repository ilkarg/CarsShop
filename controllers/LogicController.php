<?php

include __DIR__ . "/../models/Feedback.php";
include __DIR__ . "/../models/Order.php";

class LogicController {
	public static function addFeedback() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $feedback_model = new Feedback($data["fio"], $data["email"], $data["message"]);
            $feedback = QueryController::addFeedbackQuery(
                $feedback_model->fio,
                $feedback_model->email,
                $feedback_model->message
            );
            echo $feedback;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getAllFeedbacks() {
        $feedbacks = QueryController::getAllFeedbacksQuery();
        echo $feedbacks;
    }

    public static function createOrder() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $order_model = new Order($data["name"], $data["email"], $data["phone"], $data["model"]);
            $order = QueryController::addOrderQuery(
                $order_model->name,
                $order_model->email,
                $order_model->phone,
                $order_model->model
            );
            echo $order;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getAllOrders() {
        $orders = QueryController::getAllOrdersQuery();
        echo $orders;
    }
}