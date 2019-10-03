<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse; // on ajoute la classe de réponse json
use Psr\Log\LoggerInterface; // Important de récupérer la classe pour l'utiliser dans nos fichiers
use Twig\Environment;
use App\Service\RandomHelper; // Ne pas oublier de use le service
use App\Entity\Monkey;
use Doctrine\ORM\EntityManagerInterface;


class DataController extends AbstractController
{

    /**
     * @Route("/create", name="create") // ajout d'une propriété name
     **/
    public function new (EntityManagerInterface $em) {
        $monkey = new Monkey();
        $monkey->setNom('Titou')
            ->setSexe('F')
            ->setFamille('Babouin')
            ->setAge(25)
            ->setAlimentation('Végétarien')
            ->setEntree(new \DateTime());

        $em->persist($monkey);
        $em->flush();

        return new Response(sprintf(
            'Welcome to our new resident : %s !',
            $monkey->getNom() // on récupère le nom du simple pour un retour un peu plus sympa
        ));
    }

    /**
     * @Route("/list", name="list") // ajout d'une propriété name
     **/
    public function list (EntityManagerInterface $em) {
        $repository = $em->getRepository(Monkey::class);

        $monkeys = $repository->findAllMaleMonkey(); // On l'utilise de la même manière que les autres fonctions !

        if(!$monkeys) {
            throw $this->createNotFoundException('Sorry, no monkey came for the banana this time');
        }

        return $this->render('monkey.html.twig', [
            "monkeys" => $monkeys
        ]);
    }
}