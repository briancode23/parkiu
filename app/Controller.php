<?php
/**
 * Base Controller Class
 */
abstract class Controller
{
    protected $data = [];
    protected $layout = 'layouts.app';
    protected $layoutAdmin = 'layouts.admin';

    /**
     * Render view with layout (legacy compatibility)
     */
    protected function render($view, $data = [], $meta = [])
    {
        if (!is_array($meta)) {
            $meta = [];
        }
        
        $this->data = array_merge($this->data, $data);
        $this->data['controller'] = $this;

        $contentPath = VIEWS_PATH . '/' . str_replace('.', '/', $view) . '.php';
        if (!file_exists($contentPath)) {
            die("View not found: {$contentPath}");
        }

        extract($this->data);
        ob_start();
        include $contentPath;
        $__content__ = ob_get_clean();

        $layoutPath = VIEWS_PATH . '/' . str_replace('.', '/', $this->layout) . '.php';
        if (!file_exists($layoutPath)) {
            return $__content__;
        }

        $this->data['__content__'] = $__content__;
        extract($this->data);

        ob_start();
        include $layoutPath;
        return ob_get_clean();
    }

    /**
     * Redirect helper
     */
    protected function redirect($url)
    {
        if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0 || strpos($url, '/') === 0 || strpos($url, '?') === 0) {
            header("Location: {$url}");
        } else {
            header("Location: " . rtrim(APP_URL, '/') . '/' . ltrim($url, '/'));
        }
        exit;
    }

    /**
     * Load a model instance
     */
    protected function model($model)
    {
        $modelFile = MODELS_PATH . '/' . $model . '.php';
        if (!file_exists($modelFile)) {
            http_response_code(404);
            die("Model {$model} tidak ditemukan!");
        }

        require_once $modelFile;

        if (!class_exists($model)) {
            http_response_code(404);
            die("Class {$model} tidak didefinisikan!");
        }

        return new $model;
    }

    /*protected function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('?url=auth/login');
            exit;
        }
    }*/

    /*protected function requireRole($roles)
    {
        $this->requireLogin();

        if (is_string($roles)) {
            $roles = [$roles];
        }

        if (!in_array($_SESSION['user']['role'] ?? '', $roles, true)) {
            $this->redirect('?url=auth/login');
            exit;
        }
    }*/

    /*protected function auth($roles)
    {
        $this->requireRole($roles);
    }*/

    protected function getRoleText()
    {
        if (!isset($_SESSION['user']['role'])) {
            return '';
        }

        switch ($_SESSION['user']['role']) {
            case 'admin':
                return 'Admin';
            case 'petugas':
                return 'Petugas';
            case 'owner':
                return 'Owner';
            default:
                return ucfirst($_SESSION['user']['role']);
        }
    }

    protected function logActivity($id_user, $aktivitas)
    {
        if (empty($id_user)) {
            return;
        }

        $this->model('Log')->add((int) $id_user, $aktivitas);
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function setFlash($message, $type = 'success')
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public function getFlash()
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
