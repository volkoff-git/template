<?php

abstract class Module extends App
{
    public string $module;
    public string $action;
    public string $param;

    public array $allowed_actions = [];


    public function __construct($module, $action, $param)
    {
        parent::__construct();

        $this->module = $module;
        $this->action = $action;
        $this->param = $param;

        if(in_array($action, $this->allowed_actions))
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
        echo $this->renderFragment($layout, ['content' => $content]);
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