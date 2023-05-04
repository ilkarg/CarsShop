<?php

use PHPTemplater\Template;
use PHPView\View;
use PHPExceptionHandler\ExceptionHandler;

class PageController {
	public static function index() {
        $template = new Template(__DIR__ . "/../pages/index.html");
        echo View::createFromTemplate($template);
    }

    public static function login() {
        $template = new Template(__DIR__ . "/../pages/login.html");
        echo View::createFromTemplate($template);
    }

    public static function registration() {
        $template = new Template(__DIR__ . "/../pages/registration.html");
        echo View::createFromTemplate($template);
    }

    public static function news() {
        $template = new Template(__DIR__ . "/../pages/news.html");
        echo View::createFromTemplate($template);
    }

    public static function posts() {
        $template = new Template(__DIR__ . "/../pages/posts.html");
        echo View::createFromTemplate($template);
    }

    public static function car1() {
        $template = new Template(__DIR__ . "/../pages/car1.html");
        echo View::createFromTemplate($template);
    }

    public static function car2() {
        $template = new Template(__DIR__ . "/../pages/car2.html");
        echo View::createFromTemplate($template);
    }

    public static function car3() {
        $template = new Template(__DIR__ . "/../pages/car3.html");
        echo View::createFromTemplate($template);
    }

    public static function car4() {
        $template = new Template(__DIR__ . "/../pages/car4.html");
        echo View::createFromTemplate($template);
    }

    public static function car5() {
        $template = new Template(__DIR__ . "/../pages/car5.html");
        echo View::createFromTemplate($template);
    }

    public static function car6() {
        $template = new Template(__DIR__ . "/../pages/car6.html");
        echo View::createFromTemplate($template);
    }

    public static function car7() {
        $template = new Template(__DIR__ . "/../pages/car7.html");
        echo View::createFromTemplate($template);
    }

    public static function car8() {
        $template = new Template(__DIR__ . "/../pages/car8.html");
        echo View::createFromTemplate($template);
    }

    public static function car9() {
        $template = new Template(__DIR__ . "/../pages/car9.html");
        echo View::createFromTemplate($template);
    }

    public static function car10() {
        $template = new Template(__DIR__ . "/../pages/car10.html");
        echo View::createFromTemplate($template);
    }

    public static function car11() {
        $template = new Template(__DIR__ . "/../pages/car11.html");
        echo View::createFromTemplate($template);
    }

    public static function car12() {
        $template = new Template(__DIR__ . "/../pages/car12.html");
        echo View::createFromTemplate($template);
    }

    public static function cars() {
        $template = new Template(__DIR__ . "/../pages/cars.html");
        echo View::createFromTemplate($template);
    }

    public static function company() {
        $template = new Template(__DIR__ . "/../pages/company.html");
        echo View::createFromTemplate($template);
    }

    public static function contacts() {
        $template = new Template(__DIR__ . "/../pages/contacts.html");
        echo View::createFromTemplate($template);
    }

    public static function feedback() {
        $template = new Template(__DIR__ . "/../pages/feedback.html");
        echo View::createFromTemplate($template);
    }

    public static function admin() {
        $template = new Template(__DIR__ . "/../pages/admin/admin.html");
        echo View::createFromTemplate($template);
    }

    public static function adminCars() {
        $template = new Template(__DIR__ . "/../pages/admin/cars.html");
        echo View::createFromTemplate($template);
    }

    public static function adminFeedback() {
        $template = new Template(__DIR__ . "/../pages/admin/feedback.html");
        echo View::createFromTemplate($template);
    }

    public static function adminNews() {
        $template = new Template(__DIR__ . "/../pages/admin/news.html");
        echo View::createFromTemplate($template);
    }
}