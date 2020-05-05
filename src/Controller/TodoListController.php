<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use App\Form\TodoType;
use App\Service\FrequenceMots;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Twig\Environment;

class TodoListController extends AbstractController
{
    /**
     *@Route("/projets/{ProjetId}/todoliste", name="afficherTodosPourUnProjet")
    */
    public function afficherTodos(TodoRepository $TodoRepository, FrequenceMots $frequencemots, $ProjetId)
    {
        $todos = $TodoRepository->findBy(['Projet_id' => $ProjetId]);

        $string = $frequencemots->getAllTodosInOneString($todos);
        $words = $frequencemots->getAllWordsInAnArray($string);
        $words = $frequencemots->getWordsCount($words);
        $string = $frequencemots->getWordMax($words);

        return $this->render('todo/displayTodos.html.twig', ['todos' => $todos, 'ProjetId' => $ProjetId, 'Mot' => $string]);
    }

    /**
    *@Route("/projets/{ProjetId}/ajoutertodo", name="ajouterTodo")
    */
    public function createTodo(Request $request, $ProjetId)
    {
        $todo = new Todo();
        $todo->setTodoDateLimite(new \DateTime('tomorrow'));
        $todo->setProjetId($ProjetId);

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $todo = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('afficherTodosPourUnProjet', ['ProjetId' => $ProjetId]);
        }

        return $this->render('todo/createTodo.html.twig', ['form' => $form->createView()]);
    }

    /**
    *@Route("/projets/{ProjetId}/todoliste/{TodoId}/supprimertodo", name="supprimerTodo")
    */
    public function deleteTodo(TodoRepository $TodoRepository, $ProjetId, $TodoId)
    {
        $todo = $TodoRepository->find($TodoId);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($todo);
        $entityManager->flush();

        return $this->redirectToRoute('afficherTodosPourUnProjet', ['ProjetId' => $ProjetId]);
    }

    /**
    *@Route("/projets/{ProjetId}/todoliste/{TodoId}", name="afficherUnTodo")
    */
    public function afficherUnTodo(TodoRepository $TodoRepository, $TodoId)
    {
        $todo = $TodoRepository->find($TodoId);

        return new Response ($this->render('todo/detailsTodo.html.twig', ['todo' => $todo]));
    }
}