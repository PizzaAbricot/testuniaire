<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BoutiqueService;
class BoutiqueController extends AbstractController {
    
     public function index(BoutiqueService $boutique) {
        $categories = $boutique->findAllCategories();
         return $this->render('boutique.html.twig',['categories'=>$categories]);
     }
     
      public function rayon(BoutiqueService $boutique, $idCategorie) {
           $produits = $boutique->findProduitsByCategorie($idCategorie);
         return $this->render('boutique.html.twig',['categories'=>$produits]);
     }
}
