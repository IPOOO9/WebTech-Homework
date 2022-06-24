<?php

namespace root\app6\Controller;

use Twig\Environment;

class MainController {
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function showMessages($messages, $isAdmin) {
        if ($isAdmin) return $this->twig->render('messages_admin.html.twig', ['messages' => $messages]);
        else return $this->twig->render('messages.html.twig', ['messages' => $messages]);
    }
}
