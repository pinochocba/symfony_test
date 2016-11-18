<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyController extends Controller
{
    /**
     * @Route("/company", name="company_list")
     */
    public function listAction()
    {
        $company = $this->getDoctrine()
            ->getRepository('AppBundle:Company')
            ->findAll();
        return $this->render('company/index.html.twig', array(
            'companies' => $company
        ));
    }

    /**
     * @Route("/company/create", name="company_create")
     */
    public function createAction(Request $request)
    {
        $company = new Company();

        $form = $this->createFormBuilder($company)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('gcompanys', 'entity', array(
                'class' => 'AppBundle:GroupCompanys',
                'property' => 'name',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create Company' ,'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $description = $form['description']->getData();
            //$gcompanys = $form['gcompanys']->getDataClass();

            $company->setName($name);
            $company->setDescription($description);
            //$company->setGcompanys($gcompanys);

            $em = $this->getDoctrine()->getManager();

            $em->persist($company);
            $em->flush();

            $this->addFlash(
                'notice',
                'Company Added'
            );

            return $this->redirectToRoute('company_list');
        }

        return $this->render('company/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/company/edit/{id}", name="company_edit")
     */
    public function editAction($id, Request $request)
    {
        $company = $this->getDoctrine()
            ->getRepository('AppBundle:Company')
            ->find($id);

        $company->setName($company->getName());
        $company->setDescription($company->getDescription());

        $form = $this->createFormBuilder($company)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('gcompanys', 'entity', array(
                'class' => 'AppBundle:GroupCompanys',
                'property' => 'name',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Update Company' ,'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $description = $form['description']->getData();
            //$gcompanys = $form['gcompanys']->getDataClass();

            $em = $this->getDoctrine()->getManager();
            $company = $em->getRepository('AppBundle:Company')->find($id);

            $company->setName($name);
            $company->setDescription($description);
            //$company->setGcompanys($gcompanys);

            $em->flush();

            $this->addFlash(
                'notice',
                'Company Update'
            );

            return $this->redirectToRoute('company_list');
        }

        return $this->render('company/edit.html.twig', array(
            'companies' => $company,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/company/details/{id}", name="company_details")
     */
    public function detailsAction($id)
    {
        $company = $this->getDoctrine()
            ->getRepository('AppBundle:Company')
            ->find($id);
        return $this->render('company/details.html.twig', array(
            'companies' => $company
        ));
    }

    /**
     * @Route("/company/delete/{id}", name="company_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository('AppBundle:Company')->find($id);

        $em->remove($company);
        $em->flush();

        $this->addFlash(
            'notice',
            'Company Deleted'
        );

        return $this->redirectToRoute('company_list');
    }
}