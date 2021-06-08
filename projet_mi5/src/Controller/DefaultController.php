<?php
// Controller/DefaultController.php
namespace App\Controller;
use App\Service\BoutiqueService;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController {


    public function index(){

        return $this->render('base.html.twig',[

        ]);
    }
    
      public function contact(){
        return $this->render('contact.html.twig',[
        ]);
    }
     public function boutique(BoutiqueService $boutique) {
        $categories = $boutique->findAllCategories();
         return $this->render('boutique.html.twig',['categories'=>$categories]);
     }
     
   public function navBar(PanierService $panier){
          $nbproduit = $panier -> getNbProduits();
         return $this->render('navbar.html.twig',['nbproduit'=>$nbproduit]);
     }
}
