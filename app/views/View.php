<?php

class View
{
    //File view charging
    private $_file;

    //title of the page
    private $_title;

    function __construct($action)
    {
        $this->_file = "../app/views/".$action."View.php";
    }

    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new \Exception("The file ".$file." is not found.", 1);
        }
    }

    //Générer la vue à afficher
    public function generate($data)
    {
        //Contenue de la page à générer
        $pageContent = $this->generateFile($this->_file, $data);

        //Default Layout
        $view = $this->generateFile('../app/views/layouts/DefaultlayoutView.php', array('title' => $this->_title, 'pageContent' => $pageContent));
        echo $view;
    }
}