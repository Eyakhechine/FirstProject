<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom ;
use App\Repository\ClassroomRepository ;
use App\Form\ClassroomType; 

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    
    /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {$rep=$this->getDoctrine()->getRepository(classroom::class);

        $classrooms =$rep-> findAll();

        return $this->render('classroom/list.html.twig', [
            'class' => $classrooms,
        ]);
    }

    
    /**
     * @Route("/add", name="add")
     */
    public function add(request $request): Response
    {   
        $classroom = new Classroom(); 
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);
        if($form->isSubmitted()){
        $classroom= $form->getData();
        $em=$this->getDoctrine()->getManager();
        $em->persist($classroom);
        $em->flush();
        return $this->redirectToRoute('list');

        }
        return $this->render('classroom/add.html.twig', [
            'formA' => $form ->createView(),
            
        ]);
    }

    
    /**
     * @Route("/update/{id}", name="update")
     */
    public function update(request $request,$id): Response
    {   
        
        $rep=$this->getDoctrine()->getRepository(classroom::class);
        $classroom=$rep->find($id);
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);

        if($form->isSubmitted()){
          
            $em=$this->getDoctrine()->getManager();
           
            $em->flush();
            return $this->redirectToRoute('list');

        }
        return $this->render('classroom/update.html.twig', [
            'formA' => $form ->createView(),
            
        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id): Response
    { $rep=$this->getDoctrine()->getRepository(classroom::class);
      $em=$this->getDoctrine()->getManager();
      $classroom=$rep->find($id);
      $em->remove($classroom);
      $em->flush();

        return $this->redirectToRoute('list');
       
    }
}
