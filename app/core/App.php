<?php
/**
 * Mini front-controller / router.
 * URL pattern   /controller/method/param1/…
 * Default route login@index
 */
class App
{
    /** String while resolving, becomes the instantiated controller later */
    protected string|object $controller = 'login';
    protected string        $method     = 'index';
    protected array         $params     = [];

    public function __construct()
    {
        /* ---- default home controller when already logged in ---- */
        if (isset($_SESSION['auth'])) {
            $this->controller = 'home';
        }

        $url = $this->parseUrl();                // ['notes','edit','5'] etc.

        /* ---------- controller ---------- */
        if (!empty($url[0]) &&
            file_exists(CONTROLLERS . DS . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once CONTROLLERS . DS . $this->controller . '.php';
        $this->controller = new $this->controller;   // now an object

        /* ---------- method ---------- */
        if (!empty($url[1]) &&
            method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        /* ---------- remaining pieces are params ---------- */
        $this->params = $url ? array_values($url) : [];

        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }

    /** return ['segment','segment',…]  (no empty items) */
    private function parseUrl(): array
    {
        $raw = $_SERVER['REQUEST_URI'] ?? '/';

        return array_values(                  // re-index 0,1,2…
            array_filter(
                explode('/', filter_var(rtrim($raw, '/'), FILTER_SANITIZE_URL)),
                'strlen'                      // drop any ‘’ element
            )
        );
    }
}
