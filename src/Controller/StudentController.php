<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student ;
use App\Repository\StudentRepository;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Request;
class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

 /**
     * @Route("/lists", name="lists")
     */
    public function lists(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep-> findAll();

        return $this->render('student/lists.html.twig', [
            'stud' => $student,
        ]);
    }

    
    /**
     * @Route("/adds", name="adds")
     */
    public function adds(Request $request): Response
    {
        $student=new Student() ; // nouvelle instance 
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
if ($form->isSubmitted())
{
$student=$form->getData();
$em=$this->getDoctrine()->getManager();
$em->persist($student);
$em->flush();
return $this->redirectToRoute('lists');
}


        return $this->render('student/adds.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
     /**
     * @Route("/updates/{nsc}", name="updates")
     */
    public function updates(Request $request, $nsc): Response
    { $rep=$this->getDoctrine()->getRepository(Student::class);
        $student=$rep->find($nsc); // nouvelle instance 
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
if ($form->isSubmitted())
{

$em=$this->getDoctrine()->getManager();
$em->flush();
return $this->redirectToRoute('lists');
}


        return $this->render('student/updates.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
    /**
     * @Route("/deletes/{nsc}", name="deletes")
     */
    public function deletes($nsc): Response
    { $rep=$this->getDoctrine()->getRepository(Student::class);
      $em=$this->getDoctrine()->getManager();
      $student=$rep->find($nsc);
      $em->remove($student);
      $em->flush(); //recuperation lkhedma send to database 

        return $this->redirectToRoute('lists');
       
    }
}
