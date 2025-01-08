<?php
include './header.php';
require_once '../config/config.php';
include '../classes/productClass.php';

$db = new Database();
$pdo = $db->getConn();

$product = new product($pdo);

?>

<div class="records table-responsive">

    <div class="record-header">
        <div class="add">
            <span>Products</span>
            <button id="addProductBtn">Add Product</button>
        </div>

        <div class="browse">
            <input type="search" placeholder="Search" class="record-search">
        </div>
    </div>

    <div>
        <table width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th><span class="las la-sort"></span> PHOTO</th>
                    <th><span class="las la-sort"></span> NAME</th>
                    <th><span class="las la-sort"></span> DESCRIPTION</th>
                    <th><span class="las la-sort"></span> PRIX</th>
                    <th><span class="las la-sort"></span> QUANTITE</th>
                    <th><span class="las la-sort"></span> ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $product->diplayProduct();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 30px;" id="addProductPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn" id="closePopupBtn">&times;</span>
        <h2>Add Product</h2>
        <form action="../productManager/addProduct.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="productId" name="productId">

            <label for="productName">Name:</label>
            <input type="text" id="productName" name="productName" required>

            <label for="productDescription">Description:</label>
            <textarea id="productDescription" name="productDescription" required></textarea>

            <label for="productPrice">Price:</label>
            <input type="number" id="productPrice" name="productPrice" required>

            <label for="productQuantity">Quantity:</label>
            <input type="number" id="productQuantity" name="productQuantity" required>

            <label for="productImage">Image:</label>
            <input type="url" id="productImage" name="productImage" required>

            <button type="submit" id="addProduct" name="addProduct">Add Product</button>
        </form>
    </div>
</div>

<style>
    .popup {
        display: none;
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

    // edit.onclick = function() {
    //     popup.style.display = "flex";
    //     addProduct.style.display = "none";
    //     editProduct.style.display = "block";
    //     console.log("latifa");
        
    // };

    closePopupBtn.onclick = function() {
        popup.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none";
        }
    };

    const  openpopup = (id, name, description, prix, quantite, image) => {
        popup.style.display = "flex";
        addProduct.style.display = "none";
        editProduct.style.display = "block";
        inputId.value = id;
        inputName.value = name;
        inputDescription.value = description;
        inputPrice.value = prix;
        inputQuantity.value = quantite;
        inputImage.value = image;
    };
</script>

</body>

</html>