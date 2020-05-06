<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Form\ProjetType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProjetController extends AbstractController
{
    /**
     * @Route("/creerProjet", name="creerProjet")
    */
    public function createProjet(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $projet = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('afficherProjets');
        }

        return $this->render('projet/createProjet.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/projets", name="afficherProjets")
    */ 
    public function afficherProjets(ProjetRepository $ProjetRepository)
    {
        $projets = $ProjetRepository->findAll();

        return $this->render('projet/displayProjects.html.twig', ['projets' => $projets]);
    }  

    
    /**
     *@Route("/projets/{ProjetId}/supprimerProjet", name="supprimerProjet")
    */
    public function deleteProjet(ProjetRepository $ProjetRepository, $ProjetId)
    {
        $projet = $ProjetRepository->find($ProjetId);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirectToRoute('afficherProjets');   
    }


}
