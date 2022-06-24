<?php

namespace root\app5;

use Twig\Environment;

class Controller {
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function __invoke() {
        return $this->twig->render('showTable.html.twig');
    }

    public function showTable($results) {
        echo $this->twig->render('showTable.html.twig', ['tabl' => $results]);
    }
}