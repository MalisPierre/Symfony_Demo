<?php

namespace UserManagement\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@CommonBundle/Default/index.html.twig');
    }
}
