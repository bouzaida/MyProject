<?php

// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    
     #[Route("/users", name:"user_list")]
     
    public function list(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    
     #[Route("/user/add", name:"user_add")]
    
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
     #[Route("/user/{id}/delete", name:"user_delete")]
     
    public function delete(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('user_list');
    }

    
     #[Route("/user/{id}", name:"user_details")]
     
    public function details(User $user): Response
    {
        return $this->render('user/details.html.twig', [
            'user' => $user,
        ]);
    }

    public function getId(): int
{
    return $this->id;
}
}
