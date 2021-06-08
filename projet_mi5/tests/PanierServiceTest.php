<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Product;
use App\Service\PanierService;
use App\Service\BoutiqueService;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;


class PanierServiceTest extends TestCase
{
    //Méthode pour vérifier le contenu du panier
    public function testGetContenuePanier()
    {
        //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);

       

      //on rédéfini la méthode get session idProduit => quantité
      $session->method('get')->willreturn([1=>5,2=>5,3=>2]);
      

     //créer une instance de la classe PanierService
     $panierService = new PanierService($session,$boutiqueService);


      $res =  $panierService->getContenu();
      //on vérifie que le resultat de la method get contenu n'est pas vide
      $this->assertNotEmpty($res);
      //Faillure car le panier en session n'est jamais récupérer
    }
    public function testGetTotalPanier()
    {
      //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);


      //on rédéfini la méthode get session idProduit => quantité
      $session->method('get')->willreturn([1=>5,2=>5,3=>2]);
     
    

     //créer une instance de la classe PanierService
     $panierService = new PanierService($session,$boutiqueService);


      $res = $panierService->getTotal();
      $this->assertEquals(12, $res);
    }

    public function testGetNbProduitsPanier()
    {
        //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);
 

      //on rédéfini la méthode get session idProduit => quantité
      $session->method('get')->willreturn([1=>5,2=>5,3=>2]);
      
      

     $panierService = new PanierService($session,$boutiqueService);


      $res = $panierService->getNbProduits();
      //on vérifie que le resultat de la methode renvoie bien un résultat égale à 12
      $this->assertEquals(12, $res);
    }

    public function testAjouterProduitsPanier()
    {
        //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);

      //on rédéfini la méthode get session idProduit => quantité
      $session->method('get')->willreturn([]);

      $panierService = new PanierService($session,$boutiqueService);


      $panierService->ajouterProduit(1,1);
      $res = $panierService->getNbProduits();
      //On vérifie que l'on a bien ajouter un article dans le panier
      $this->assertEquals(1, $res);
    }

    //fonction test pour enlever une quantiter d'un produit
    public function testEnleverProduitPanier()
    {
      //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);

      $session->method('get')->willreturn([1=>5]);

      $panierService = new PanierService($session,$boutiqueService);


      $panierService->enleverProduit(1,4);
      $res = $panierService->getNbProduits();
      $this->assertEquals(1, $res);
    }

    //fonction qui permet de tester si un produit et sa quantité est bien supprimer
    public function testSupprimerProduit(){
        //Création des bouchons pour les objets instancé
       $session = $this->createMock(SessionInterface::class);
       $boutiqueService = $this->createMock(BoutiqueService::class);

       //on rédéfini la méthode get session idProduit => quantité
       $session->method('get')->willreturn([1=>5, 2=>3]);

       $panierService = new PanierService($session,$boutiqueService);


        $panierService->supprimerProduit(1);
        $res = $panierService->getNbProduits();
        $this->assertEquals(3, $res);
        $panierService->supprimerProduit(2);
        $res = $panierService->getNbProduits();
        $this->assertEmpty($res);

    }

    // fonction qui permeter de tester de vider complètement le panier
    public function testViderPanier() {
      //Création des bouchons pour les objets instancé
      $session = $this->createMock(SessionInterface::class);
      $boutiqueService = $this->createMock(BoutiqueService::class);

      //on rédéfini la méthode get session idProduit => quantité
      $session->method('get')->willreturn([1=>5, 2=>3]);

      $panierService = new PanierService($session,$boutiqueService);


      $panierService->vider();
      $res = $panierService->getNbProduits();
      $this->assertEmpty($res);

    }

}
