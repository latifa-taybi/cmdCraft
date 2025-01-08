<?php
require_once '../config/config.php';
require_once '../classes/productClass.php';


$db = new Database();
$pdo = $db->getConn();
$product = new product($pdo);
$productEdit = $product->getProductId($_GET['id']);


?>

<main>
    <div style="margin-top: 30px; display: flex" id="addProductPopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" id="closePopupBtn">&times;</span>
            <h2>Edit Product</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="productId" name="productId" value="<?php if(isset($productEdit)) { echo $productEdit['id_product']; } ?>">

                <label for="productName">Name:</label>
                <input type="text" id="productName" name="productName" value="<?php if(isset($productEdit)) { echo $productEdit['name']; } ?>" required>

                <label for="productDescription">Description:</label>
                <textarea id="productDescription" name="productDescription" required><?php if(isset($productEdit)) { echo $productEdit['description']; } ?></textarea>

                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" name="productPrice" value="<?php if(isset($productEdit)) { echo $productEdit['prix']; } ?>"  required>

                <label for="productQuantity">Quantity:</label>
                <input type="number" id="productQuantity" name="productQuantity" value="<?php if(isset($productEdit)) { echo $productEdit['quantite']; } ?>"  required>

                <label for="productImage">Image:</label>
                <input type="url" id="productImage" name="productImage" value="<?php if(isset($productEdit)) { echo $productEdit['image']; } ?>"  required>

                <button type="submit" id="editProduct" name="editProduct" onclick="closepopup()">Edit Product</button>
            </form>
        </div>
    </div>

</main>

<?php
if(isset($_POST['editProduct'])){
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice =$_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $productImage = $_POST['productImage'];
    $product->editProduct($productId, $productName, $productDescription, $productPrice, $productQuantity, $productImage);
    header('Location: ../dashboard/productList.php');
}
?>

<style>

    .popup {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        cursor: pointer;
    }

    form label {
        display: block;
        margin: 10px 0 5px;
    }

    form input,
    form textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    const popup = document.getElementById("addProductPopup");
    const addProductBtn = document.getElementById("addProductBtn");
    const closePopupBtn = document.getElementById("closePopupBtn");
    const edit = document.querySelector(".edit");
    const addProduct = document.getElementById("addProduct");
    const editProduct = document.getElementById("editProduct");
    const inputId = document.getElementById("productId");
    const inputName = document.getElementById("productName");
    const inputDescription = document.getElementById("productDescription");
    const inputPrice = document.getElementById("productPrice");
    const inputQuantity = document.getElementById("productQuantity");
    const inputImage = document.getElementById("productImage");

    console.log("test");

    addProductBtn.onclick = function() {
        popup.style.display = "flex";
    };

    edit.onclick = function() {
        popup.style.display = "flex";
        addProduct.style.display = "none";
        editProduct.style.display = "block";
        console.log("latifa");
        
    };

    closePopupBtn.onclick = function() {
        popup.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    };
</script>