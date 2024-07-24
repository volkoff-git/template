<?php

abstract class Module extends App
{
    public string $module;
    public string $action;
    public string $param;

    public array $allowed_actions = [];


    public function __construct($params)
    {
        parent::__construct();

        $module = $this->module = $params['module'];
        $action = $this->action = $params['action'];
        $param = $this->param = $params['param'];
        $user = $this->user = $params['user'];

        if(in_array($this->action, $this->allowed_actions))
        {
            if(is_callable(array($this, $action))){
                $this->$action($param);
            }
            else
            {
                // Есть в allowed_actions, нет фактически метода
                $this->f(['error' => 'нет вызываемого метода из спика разрешенных'], 'e');
            }

        }
        elseif (in_array('index', $this->allowed_actions))
        {
            if(is_callable(array($this, 'index'))){
                $this->index($action);
            }
            else
            {
                $this->f(['error' => 'нет вызываемого индекса из спика разрешенных '], 'e');

            }
        }
        else
        {
            $this->f(['error' => 'no action in allowed actions'.$action], 'e');
        }
    }
    public function renderPage($view, $params = [], $layout = 'mainLayout'): void
    {
        $content =  $this->renderFragment($view, $params);
        echo $this->renderFragment($layout, [
            ...$params,
            'content' => $content,
            'attach_js' => $this->attach()

        ]);
    }

    protected function inject($file, $type = 'css', $params = []): void
    {
        ob_start();
        include($_SERVER['DOCUMENT_ROOT'].$file);
        $f_content = ob_get_clean();
        if($type == 'css')
        {
            echo  "<style>$f_content</style>";
        }
        if($type == 'js')
        {
            $script_opts = '';
            if(isset($params['script_opts'])){
                $script_opts = $params['script_opts'];
            }
            echo  "<script $script_opts>$f_content</script>";
        }


    }

    private function attach()
    {

        if(file_exists(__DIR__.'/../public/js/'.$this->module.'.js'))
        {
            return "<script defer src='/js/$this->module.js'></script>";
        }
        else
        {
            return '';
        }

    }


    public function renderFragment($view, $params = []): string
    {
        $view = str_replace('.', '/', $view);
        $view_file = $_SERVER['DOCUMENT_ROOT'].'/../views/'.$view.'.php';

        ob_start();
        include($view_file);
        return ob_get_clean();
    }
}