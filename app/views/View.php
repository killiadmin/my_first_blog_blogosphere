<?php

class View
{
    //File view charging
    private $_file;

    //title of the page
    private $_title;

    public function __construct(string $action)
    {
        $this->_file = "./app/views/".$action."View.php";
    }

    private function generateFile(string $file, array $data): string
    {
        if (file_exists($file)) {

            if ($data){
                extract($data);
            }

            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new \Exception("The file ".$file." is not found.", 1);
        }
    }

    //Générer la vue à afficher
    public function generate(array $data): void
    {
        //Contenue de la page à générer
        $pageContent = $this->generateFile($this->_file, $data);

        //Default Layout
        $view = $this->generateFile('./app/views/layouts/DefaultlayoutView.php', array(
            'title' => $this->_title,
            'pageContent' => $pageContent
        ));
        echo $view;
    }
}