<?php

function handleError($code) {
    require_once 'app/controllers/ErrorController.php';
    $errorController = new ErrorController();
    switch ($code) {
        case 403:
            $errorController->forbidden();
            break;
        case 404:
            $errorController->notFound();
            break;
        case 405:
            $errorController->methodNotAllowed();
            break;
        default:
            $errorController->forbidden();
            break;
    }
    exit;
}

class ErrorController extends Controller {

    public function forbidden() {
        http_response_code(403);
        $this->view('errors/403');
        exit;
    }

    public function notFound() {
        http_response_code(404);
        $this->view('errors/404');
        exit;
    }

    public function methodNotAllowed() {
        http_response_code(405);
        $this->view('errors/405');
        exit;
    }

}