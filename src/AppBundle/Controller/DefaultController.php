<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));

        return $this->render('AppBundle:Default:index.html.twig');
    }


    /**
     * @Route("/included-bundles", name="included-bundles")
     */
    public function includedBundlesAction()
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Included bundles');
        
        return $this->render('AppBundle:Default:demo.functions.html.twig');
    }


    /**
     * @Route("/paginator/{page}/{limit}", name="paginator_sample")
     */
    public function paginatorAction($page = 1, $limit = 10)
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Pagination example');

        $paginator = $this->get('knp_paginator');
        
        $pagination = $paginator->paginate(
            $this->getFakeData(),
            $page/*page number*/,
            $limit /*limit per page*/
        );

        return $this->render('AppBundle:Default:paginator.html.twig', array('pagination' => $pagination));
    }
    
    
    private function getFakeData()
    {
        $sampleData = [];
        for($i = 0; $i < 500; $i++) {
            $sampleData[] = ["username" => "user_" . $i];
        }

        return $sampleData;
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
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('Contact');
        
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
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addItem('Home', $this->get('router')->generate('homepage'));
        $breadcrumbs->addItem('About');

        $parsedown_service = $this->get('symfonyzero.parsermarkdown');
        $parsed_readme_file = $parsedown_service->parseReadmeUrl();

        if($parsed_readme_file){
            $render = $this->render('AppBundle:Default:docs/readme.html.twig', array("readmeFile"=>$parsed_readme_file));
        }else{
            $readme_file = $this->get('kernel')->getRootDir() . '/../README.md';
            $parsed_readme_file = $parsedown_service->parseReadmeFile(file_get_contents($readme_file));
            $render = $this->render('AppBundle:Default:docs/readme.html.twig', array("readmeFile"=>$parsed_readme_file));
        }
        
        return $render;
    }

    /**
     * @Route("/cookiepolicy", name="cookie-policy")
     */
    public function cookiepolicyAction()
    {
        return $this->render('AppBundle:Default:cookiepolicy.html.twig',array("cookieExpiryTime"=> 1));
    }
}
