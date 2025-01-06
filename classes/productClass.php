<?php
class product {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getProduct(){
        $stmt = $this->pdo->prepare("SELECT id_product, name, description, prix, quantite, image FROM product WHERE deleted=0");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductId($id){
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE id_product = :id_product");
        $stmt->execute([
            'id_product'=>$id
        ]);
        return $stmt->fetch();
    }

    public function diplayProduct(){
        $products = $this->getProduct();
        foreach ($products as $product) {
            echo "
                <tr>
                    <td># $product[id_product]</td>
                    <td>
                        <div class='client'>
                            <div class='client-img bg-img' style='background-image: url($product[image])'></div>
                        </div>
                    </td>
                    <td>
                        <div class='client'>
                            <h4>$product[name]</h4>
                        </div>
                    </td>
                    <td>
                        <h4>$product[description]</h4>
                    </td>
                    <td>
                        <h4>$product[prix]</h4>
                    </td>
                    <td>
                        <h4>$product[quantite]</h4>
                    </td>
                    <td>
                        <a class='edit' href='../dashboard/editProduct.php?id={$product['id_product']}'>
                            <span style='color:rgb(53, 250, 105);' class='las la-edit'></span>
                        </a>   
                        <a class='delete' href='../productManager/deleteProduct.php?id={$product['id_product']}'>
                            <span style='color:rgb(237, 25, 42);' class='las la-trash'></span>
                        </a>  
                    </td>
                </tr>";
        }
    }

    public function editProduct($id_product, $name, $description, $prix, $quantite, $image){
        $stmt = $this->pdo->prepare("UPDATE product SET name = :name, description = :description, prix = :prix, quantite = :quantite, image = :image WHERE id_product = :id_product");
        return $stmt->execute([
            'id_product' => $id_product,
            'name' => $name,
            'description' => $description,
            'prix' => $prix,
            'quantite' => $quantite,
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("UPDATE product SET deleted=1 WHERE id_product = :id_product");
        $stmt->execute([
            ':id_product' => $id
        ]);
    }    
}
?>