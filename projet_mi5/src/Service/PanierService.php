<?php
// src/Service/PanierService.php
namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\BoutiqueService;
// Service pour manipuler le panier et le stocker en session
class PanierService {
 ////////////////////////////////////////////////////////////////////////////
     const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
     private $session; // Le service Session
     private $boutique; // Le service Boutique
     private $panier; // Tableau associatif idProduit => quantite
 // donc $this->panier[$i] = quantite du produit dont l'id = $i
 // constructeur du service
    public function __construct(SessionInterface $session, BoutiqueService $boutique) {
    // Récupération des services session et BoutiqueService
        $this->boutique = $boutique;
        $this->session = $session;
        // Récupération du panier en session s'il existe, init. à vide sinon
         $this->panier = [];
    }

 // tableau d'éléments [ "produist" => un produit, "quantite" => quantite ]
 public function getContenu() {  
    return $this->panier;
    
 }
 // getTotal renvoie le montant total du panier
 public function getTotal() {
     return  sizeof($this->panier);    
 }
 // getNbProduits renvoie le nombre de produits dans le panier
 public function getNbProduits() {
     return  sizeof($this->panier);   
 }
 // ajouterProduit ajoute au panier le produit $idProduit en quantite $quantite
 public function ajouterProduit(int $idProduit, int $quantite = 1) { 
     for ( $i = 0 ; $i < $quantite ; $i++ ){
          array_push($this->panier, $idProduit);
     }   
 }
 // enleverProduit enlève du panier le produit $idProduit en quantite $quantite
 public function enleverProduit(int $idProduit, int $quantite = 1) {
     foreach ($this->panier as $produit) {
         $w_compteur = 0;
         if($idProduit == $produit && $quantite < $w_compteur)
              unset($this->panier[array_search($produit,$this->panier)]);
         $w_compteur++;
      }    
 }
 // supprimerProduit supprime complètement le produit $idProduit du panier
 public function supprimerProduit(int $idProduit) { 
     foreach ($this->panier as $produit) {
         if($idProduit == $produit)
              unset($this->panier[array_search($produit,$this->panier)]);
      } 
 }
 // vider vide complètement le panier
 public function vider() { 
       $this->panier = [];   
 }
    }
 
