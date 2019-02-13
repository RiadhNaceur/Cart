<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{
    public function listingAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->byCategorie($id);
        $categorie = $em->getRepository('EcommerceBundle:Categories')->find($id);
        if (!$categorie) throw $this->createNotFoundException('page n\'existe pas');
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }

    public function produitsAction()
    {
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findBy(array('disponible'=>1));
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                                                                                                    'panier' => $panier));
    }

    public function presentationAction($id)
    {
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);
        if ($session->has('panier'))
        $panier = $session->get('panier');
        else
            $panier = false;
        if (!$produit) throw $this->createNotFoundException('page n\'existe pas');
        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit' => $produit,
                                                                                                     'panier' => $panier));
    }

    public function rechercheAction()
    {
        $form = $this->createForm('EcommerceBundle\Form\RechercheType');
        return $this->render('EcommerceBundle:Default:recherche/modulesUsed/recherche.html.twig', array('form' => $form->createView()));

    }

    public function rechercheTraitementAction(Request $request)
    {
        $form = $this->createForm('EcommerceBundle\Form\RechercheType');
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('EcommerceBundle:Produits')->recherche($form['recherche']->getData());
        }
        else{
           throw $this->createNotFoundException('page n\'existe pas');
        }

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits));
    }
}

