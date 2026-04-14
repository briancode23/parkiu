<?php
/**
 * Authentication Middleware
 */
class AuthMiddleware
{
    /**
     * Check if user is authenticated
     */
     
    public static function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            self::redirect('/auth/login');
        }
    }
    
    public static function requireRole($roles) {
        self::requireLogin();
        
        if (is_string($roles)) {
            $roles = [$roles];
        }
        
        if (!in_array($_SESSION['user']['role'], $roles)) {
            self::redirect('/errors/403');
            exit;
        }
    }

    /**
     * Check if user is not authenticated
     */
    public static function requireLogout()
    {
        if (isset($_SESSION['user'])) {
            self::redirect('/dashboard');
        }
    }

    /**
     * Redirect helper
     */
    public static function redirect($path)
    {
        $url = rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
        header("Location: {$url}");
        exit;
    }

    /**
     * Start session if not started
     */
    public static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
