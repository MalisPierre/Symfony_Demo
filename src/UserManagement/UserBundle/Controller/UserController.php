<?php

namespace UserManagement\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class UserController extends Controller
{
    /**
     * @Route("/list", name="list_users")
     * @Template()
     */
    public function listAction()
    {
        $em          = $this->get('doctrine')->getManager();
        $users = $em->getRepository("UserBundle:RewardCategory")->findAll();

        if ($games == NULL)
        {
            return $this->render(
                '@UserBundle/Default/list_users.html.twig',
                array());
        }
        return array("users" => $users);
    }

    /**
     * @Route("/show/{id}", name="show_user")
     * @Template()
     */
    public function showAction($id)
    {
        $em          = $this->get('doctrine')->getManager();
        $game = $em->getRepository("GalacticGameBundle:Game")->findOneBy(array('id' => $id));
        // NEEEEEEEEEEEEED NEW REPOSITORY ENTITY FINDER FOR MODS -> GAME
        $mods = $em->getRepository("GalacticModBundle:ModObject")->findByGame($game);
	//affiche un tableau mods
	var_dump ($mods);
	 die ();
        if ($game == NULL)
        {
            return $this->render(
                'GalacticGameBundle:Game:null.html.twig',
                array());
        }
        return array("game" => $game);
    }
}
