<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GroupCompanys;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GcompanyController extends Controller
{
    /**
     * @Route("/gcompany", name="gcompany_list")
     */
    public function listAction()
    {
        $gcompany = $this->getDoctrine()
            ->getRepository('AppBundle:GroupCompanys')
            ->findAll();
        return $this->render('gcompany/index.html.twig', array(
            'gcompanies' => $gcompany
        ));
    }

    /**
     * @Route("/gcompany/create", name="gcompany_create")
     */
    public function createAction(Request $request)
    {
        $gcompany = new GroupCompanys();

        $form = $this->createFormBuilder($gcompany)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create Group Company' ,'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $description = $form['description']->getData();
            //$gcompanys = $form['gcompanys']->getDataClass();

            $gcompany->setName($name);
            $gcompany->setDescription($description);
            //$company->setGcompanys($gcompanys);

            $em = $this->getDoctrine()->getManager();

            $em->persist($gcompany);
            $em->flush();

            $this->addFlash(
                'notice',
                'Group Company Added'
            );

            return $this->redirectToRoute('gcompany_list');
        }

        return $this->render('gcompany/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/gcompany/edit/{id}", name="gcompany_edit")
     */
    public function editAction($id, Request $request)
    {
        $gcompany = $this->getDoctrine()
            ->getRepository('AppBundle:GroupCompanys')
            ->find($id);

        $gcompany->setName($gcompany->getName());
        $gcompany->setDescription($gcompany->getDescription());

        $form = $this->createFormBuilder($gcompany)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Update Group Company' ,'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $description = $form['description']->getData();
            //$gcompanys = $form['gcompanys']->getDataClass();

            $em = $this->getDoctrine()->getManager();
            $gcompany = $em->getRepository('AppBundle:GroupCompanys')->find($id);

            $gcompany->setName($name);
            $gcompany->setDescription($description);
            //$company->setGcompanys($gcompanys);

            $em->flush();

            $this->addFlash(
                'notice',
                'Group Company Update'
            );

            return $this->redirectToRoute('gcompany_list');
        }

        return $this->render('gcompany/edit.html.twig', array(
            'companies' => $gcompany,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/gcompany/details/{id}", name="gcompany_details")
     */
    public function detailsAction($id)
    {
        $gcompany = $this->getDoctrine()
            ->getRepository('AppBundle:GroupCompanys')
            ->find($id);
        return $this->render('gcompany/details.html.twig', array(
            'gcompanies' => $gcompany
        ));
    }

    /**
     * @Route("/gcompany/delete/{id}", name="gcompany_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $gcompany = $em->getRepository('AppBundle:GroupCompanys')->find($id);

        try {
            $em->remove($gcompany);
            $em->flush();
            $this->addFlash(
                'notice',
                'Group Company Deleted'
            );
        } catch (\Doctrine\DBAL\EXception\ForeignKeyConstraintViolationException $e){
            $this->addFlash(
                'error',
                'Cannot delete a parent row: a foreign key constraint fails'
            );
        }

        return $this->redirectToRoute('gcompany_list');
    }
}