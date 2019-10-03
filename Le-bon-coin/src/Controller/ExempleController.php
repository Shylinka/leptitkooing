<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse; // on ajoute la classe de réponse json
use Psr\Log\LoggerInterface; // Important de récupérer la classe pour l'utiliser dans nos fichiers
use Twig\Environment;
use App\Service\RandomHelper; // Ne pas oublier de use le service


class ExempleController extends AbstractController
{
    public $nbRandom;
    public $arrayPrenoms = array("Claire","Carole","Kiki", "Tritri", "Krikri", "Jean-Charles", "Alix", "Gusgus", "Toitoine", "Peppa");
    public $arrayNom = array("Duguey","Granger","Rourou", "Gege", "Garnier", "The Pow", "Boniot", "Giraudier", "Dousse", "Pig");
    public $arrayVerbe = array("a mangé", "a tué", "a marché sur", "s'est fait écraser par");
    public $arrayCOD = array("ma grand mère", "mon chien", "mon réveil", "une voiture", "Winnie");

    /**
     * @Route("/", name="homepage") // ajout d'une propriété name
     **/
    public function index(LoggerInterface $logger) {
        $logger->info('Webédiable');
        return $this->render('index.html.twig', [
            'title' => 'Bienvenue !'

        ]);
    }

    /**
     * @Route("/login", name="loginpage")
     **/
    public function loginpage()
    {
        return $this->render('login.html.twig', [
            'title' => 'Page de connexion'
        ]);
    }

    /**
     * @Route("/signin", name="signinpage")
     **/
    public function signinpage()
    {
        return $this->render('signin.html.twig', [
            'title' => 'Page inscription'
        ]);
    }

//    public function index() {
//        $nbRandomPrenom=random_int(0,9);
//        $nbRandomNom=random_int(0,9);
//        $nbRandomVerbe=random_int(0,3);
//        $nbRandomCOD=random_int(0,4);
//
//        return $this->render('index.html.twig', [
//            'title' => 'Générateur d excuses','prenom'=> $this->arrayPrenoms[$nbRandomPrenom],
//            'nom'=> $this->arrayNom[$nbRandomNom],
//            'verbe'=> $this->arrayVerbe[$nbRandomVerbe], 'COD'=> $this->arrayCOD[$nbRandomCOD]
//        ]);

//        return $this->render('index.html.twig', ['title'=>"bonjour"]);
//    }

    /**
     * @Route("/api", name="api_index")
     **/
    public function api() { // nouvelle route
        $data = [
            'test' => 'hello world',
            "table" => ['C’est pas faux', "Une fois, à une exécution, je m'approche d'une fille. Pour rigoler, je lui fais : « Vous êtes de la famille du pendu ? »... C'était sa sœur. Bonjour l'approche !", "C’est pour ça : j’lis jamais rien. C’est un vrai piège à cons c’t’histoire-là. En plus j’sais pas lire."]
        ];

        return new JsonResponse($data);
    }


}