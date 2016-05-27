<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/included-bundles", name="included-bundles")
     */
    public function includedBundlesAction()
    {
        return $this->render('AppBundle:Default:demo.functions.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:Default:about.html.twig');
    }

    /**
     * @Route("/paginator", name="paginator_sample")
     */
    public function paginatorAction(Request $request)
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Sample section');

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = 'SELECT a FROM AppBundle:User a';
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
        //$sampleData, /* query NOT result */
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('AppBundle:Default:paginator.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/tinyMCE-example", name="tmce_sample")
     */
    public function tinyMCEAction()
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('TinyMCE Example');

        return $this->render('AppBundle:Default:tinymce.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @Method ({"GET","POST"})
     */
    public function contactAction(Request $request)
    { 
        $form = $this->createForm(ContactType::class, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $this->get('symfonyzero.email')->sendEmail(
                $data['subject'],
                null,
                $data['email'],
                'AppBundle:Templates:mailTemplate.html.twig'
            );

            $this->addFlash('info', 'The e-mail was sent!');

            $this->redirectToRoute('contact');
        }

        return $this->render(
            'AppBundle:Default:contact.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/readme", name="readme")
     */
    public function readMeAction()
    {
        return $this->render('AppBundle:Default:docs/readme.html.twig');
    }
}
