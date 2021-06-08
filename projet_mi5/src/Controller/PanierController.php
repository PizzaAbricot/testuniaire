<?php

namespace App\Controller;
use App\Service\BoutiqueService;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PanierController extends AbstractController{

 public function index(){

        return $this->render('Panier/index.html.twig',[

        ]);
    }
    
      public function ajouter(PanierService $panier, int $id, int $quantite){
       $panier->ajouterProduit($id,$quantite);
       return $this->render('Panier/index.html.twig',[
        ]);
    }
    
      public function enlever(PanierService $panier, int $id, int $quantite){
          $panier->enleverProduit($id,$quantite);
       return $this->render('Panier/index.html.twig',[
        ]);
    }
    
      public function supprimer(PanierService $panier, int $id){
          $panier->supprimerProduit($id);
       return $this->render('Panier/index.html.twig',[
        ]);
    }
    
    public function vider(PanierService $panier){
        $panier->vider();
       return $this->render('Panier/index.html.twig',[
        ]);
    }
}
