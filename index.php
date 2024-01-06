<?php

// Interface de produit électronique
interface ElectronicProduct {
    public function displaySpecifications();
}

// Implémentation concrète de ElectronicProduct pour les smartphones
class Smartphone implements ElectronicProduct {
    public function displaySpecifications() {
        echo "Smartphone : écran de 6 pouces, configuration double caméra\n";
    }
}

// Implémentation concrète de ElectronicProduct pour les ordinateurs portables
class Laptop implements ElectronicProduct {
    public function displaySpecifications() {
        echo "Ordinateur portable : écran de 15 pouces, 8 Go de RAM, SSD de 512 Go\n";
    }
}

// Implémentation concrète de ElectronicProduct pour les écouteurs
class Headphones implements ElectronicProduct {
    public function displaySpecifications() {
        echo "Écouteurs : design circum-auriculaire, annulation de bruit\n";
    }
}

// Interface de créateur de produit électronique
interface ElectronicProductCreator {
    public function createProduct(): ElectronicProduct;
    public function getProductionProcess(): string;
}

// Implémentation concrète de ElectronicProductCreator pour les smartphones
class SmartphoneCreator implements ElectronicProductCreator {
    public function createProduct(): ElectronicProduct {
        return new Smartphone();
    }

    public function getProductionProcess(): string {
        return "Production de smartphones : Assemblage des composants, test des fonctionnalités\n";
    }
}

// Implémentation concrète de ElectronicProductCreator pour les ordinateurs portables
class LaptopCreator implements ElectronicProductCreator {
    public function createProduct(): ElectronicProduct {
        return new Laptop();
    }

    public function getProductionProcess(): string {
        return "Production d'ordinateurs portables : Assemblage du matériel, installation du logiciel\n";
    }
}

// Implémentation concrète de ElectronicProductCreator pour les écouteurs
class HeadphonesCreator implements ElectronicProductCreator {
    public function createProduct(): ElectronicProduct {
        return new Headphones();
    }

    public function getProductionProcess(): string {
        return "Production d'écouteurs : Assemblage des pièces, contrôle qualité\n";
    }
}

// Entrepôt pour stocker les produits
class ProductWarehouse {
    private $products = [];
    private $category;

    public function __construct($category) {
        $this->category = $category;
    }

    public function storeProduct(ElectronicProduct $product) {
        $this->products[] = $product;
        echo "Produit stocké dans l'entrepôt: {$this->category} \n";
    }

    public function listProducts() {
        echo "Produits stockés dans l'entrepôt {$this->category}: " . count($this->products) . "\n";
        foreach ($this->products as $product) {
            echo "- ";
            $product->displaySpecifications();
        }
        echo "\n";
    }
}

// Code client
function displayProductInformation(ElectronicProductCreator $creator, ProductWarehouse $warehouse, $number = 1) {
    for ($i = 1; $i <= $number; $i++) {
        $product = $creator->createProduct();
        $productionProcess = $creator->getProductionProcess();

        echo "Processus de production :\n$productionProcess";
        echo "Spécifications :\n";
        $product->displaySpecifications();

        // Stocker le produit dans l'entrepôt spécifique
        $warehouse->storeProduct($product);
    }
}

// Tester le code
$smartphoneWarehouse = new ProductWarehouse("Smartphone Factory");
$laptopWarehouse = new ProductWarehouse("Laptop Factory");
$headphonesWarehouse = new ProductWarehouse("Headphones Factory");

// Produire et stocker 4 smartphones
displayProductInformation(new SmartphoneCreator(), $smartphoneWarehouse, 4);
// Produire et stocker 3 ordinateurs portables
displayProductInformation(new LaptopCreator(), $laptopWarehouse, 3);
// Produire et stocker 2 écouteurs
displayProductInformation(new HeadphonesCreator(), $headphonesWarehouse, 2);

// Afficher les produits dans les entrepôts spécifiques
$smartphoneWarehouse->listProducts();
$laptopWarehouse->listProducts();
$headphonesWarehouse->listProducts();
