<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\UsersAdresses;
use EcommerceBundle\Form\UsersAdressesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{
    public function menuAction()
    {
        $session = $this->get('session');
        if ($session->has('panier'))
        $articles = count($session->get('panier'));
        else
        $articles = 0;
        return $this->render('EcommerceBundle:Default:panier/modulesUsed/panier.html.twig', array('articles' => $articles));
    }

    public function panierAction()
    {
        $session = $this->get('session');
        if (!$session->has('panier')) $session->set('panier', array());
       //$session->remove('panier');
       //die();
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));

        return $this->render('EcommerceBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits,
                                                                                'panier' => $session->get('panier')));
    }

    public function ajouterAction($id)
    {
        $session = $this->get('session');
        $request = Request::createFromGlobals();
        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');
        if (array_key_exists($id, $panier))
        {
            if ($request->query->get('qte')!=null) $panier[$id]=$request->query->get('qte');
        }
        else
        {
            if ($request->query->get('qte')!=null) $panier[$id]=$request->query->get('qte');
          else
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
        $this->get('session')->getFlashBag()->add('success','Article successfully added to cart');
       return $this->redirect($this->generateUrl('panier'));
    }

    public function supprimerAction($id)
    {
        $session = $this->get('session');
        $panier = $session->get('panier');
        unset($panier[$id]);
        $session->set('panier',$panier);
        $this->get('session')->getFlashBag()->add('success','produit supprimé avec succès');
        return $this->redirect($this->generateUrl('panier'));
    }

    public function AdrSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $adr = $em->getRepository('EcommerceBundle:UsersAdresses')->find($id);
        $em->remove($adr);
        $em->flush();
        return $this->redirect($this->generateUrl('livraison'));
    }

    public function livraisonAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $entity = new UsersAdresses();
        $form = $this->createForm('EcommerceBundle\Form\UsersAdressesType', $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();
        }
        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig', array('user' => $user,
                                                                                                'form' => $form->createView()));
    }

    public function validationAction()
    {
        return $this->render('EcommerceBundle:Default:panier/layout/validation.html.twig');
    }
}
