<?php

namespace Letscode\Bundle\MagicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LetscodeMagicBundle:Default:index.html.twig', array('name' => $name));
    }
}
