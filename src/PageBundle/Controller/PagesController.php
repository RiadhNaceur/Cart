<?php

namespace PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PageBundle:Pages')->findAll();
        return $this->render('PageBundle:Default:pages/modulesUsed/menu.html.twig', array('pages' => $pages));
    }

    public function pageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PageBundle:Pages')->find($id);
        if (!$page) throw $this->createNotFoundException('page n\'existe pas');
        return $this->render('PageBundle:Default:pages/layout/pages.html.twig', array('page' => $page));
    }
}
