<?php
defined('_JEXEC') or die('Restricted access');

class StoriesController extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = false)
    {
        // Definir a visualização
        $view = $this->input->getCmd('view', 'stories');
        $this->input->set('view', $view);

        // Obter a visualização
        $view = $this->getView($view, 'html');
        $model = $this->getModel('Stories');
        $view->setModel($model, true);
        $view->setLayout('default');
        $view->display();

        // Forçar a saída do conteúdo AMP diretamente sem o template padrão
        $this->renderOnlyLayout($view);
    }

    protected function renderOnlyLayout($view)
    {
        // Capturar o buffer do layout
        ob_start();
        $view->display();
        $output = ob_get_clean();

        // Enviar o conteúdo AMP diretamente sem adicionar cabeçalhos extras
        header('Content-Type: text/html; charset=utf-8');
        echo $output;
        exit();
    }
}
