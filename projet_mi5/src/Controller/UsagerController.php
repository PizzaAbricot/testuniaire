<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\UsagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usager")
 */
class UsagerController extends AbstractController
{

    public function index(): Response
    {
        $user=$this->getUser();
        return $this->render('usager/index.html.twig', [
            'usagers' => $user,
        ]);
    }


    public function new(Request $request): Response
    {
        $usager = new Usager();
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usager);
            $entityManager->flush();

            return $this->redirectToRoute('usager_index');
        }

        return $this->render('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form->createView(),
        ]);
    }

    public function show(Usager $usager): Response
    {
        return $this->render('usager/show.html.twig', [
            'usager' => $usager,
        ]);
    }


   /* public function edit(Request $request, Usager $usager): Response
    {
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usager_index');
        }

        return $this->render('usager/edit.html.twig', [
            'usager' => $usager,
            'form' => $form->createView(),
        ]);
    }*/


   /* public function delete(Request $request, Usager $usager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usager_index');
    }*/
}
