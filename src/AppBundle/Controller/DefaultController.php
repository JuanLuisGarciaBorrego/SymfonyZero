<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default/index.html.twig');
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");        
        $breadcrumbs->addItem("Home", $this->get("router")->generate("homepage"));        
        $breadcrumbs->addItem("Sample section");        

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM AppBundle:User a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
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
        $breadcrumbs = $this->get("white_october_breadcrumbs");        
        $breadcrumbs->addItem("Home", $this->get("router")->generate("homepage"));        
        $breadcrumbs->addItem("TinyMCE Example");        
        
        return $this->render('AppBundle:Default:tinymce.html.twig');

    }
    
    /**
     * @Route("/contact_s", name="contact_s")
     */
    public function mailAction() {
        $emailService = $this->get('symfonyzero.email');

        $email = [];
        $email['from'] = $this->getParameter('email_address');
        $email['to'] = "to@mail.com";
        $email['subject'] = $this->getParameter('contact_subject');
        $email['template'] = 'AppBundle:Templates:mailTemplate.html.twig';
        $email['url'] = null;
        $emailService->sendEmail($email['subject'], $email['from'], $email['to'], $email['template'], $email);

        return true;
    }
    
    /**
     * @Route("/contact", name="contact")
     * @Method ({"GET","POST"})     
     */
    public function contactAction(Request $request)
    {
        
        if(!empty($request->request->all())){
            $this->addFlash("info", "The e-mail would be sent!");
        }
        
        $form = $this->createForm(ContactType::class, null, array(
            'action' => $this->generateUrl('contact'),
            'method' => 'POST',
            'attr'=>array('id'=>'contact_form')
        ));

        return $this->render('AppBundle:Default:contact.html.twig', [
            'form'=>$form->createView(),
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/readme", name="readme")
     */
    public function readMeAction()
    {
        return $this->render('AppBundle:Default:docs/readme.html.twig');
    }
}
