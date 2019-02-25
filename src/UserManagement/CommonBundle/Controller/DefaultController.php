<?php

namespace UserManagement\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
    /**
     * @Route("/home", name="home")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('@CommonBundle/Default/index.html.twig');
    }
}
