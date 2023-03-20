<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TBD STORE - ADMIN</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script async src=".inventoryManagement.js"></script>
</head>
<body>
<h1>Inventory Management</h1>
<h2>Current Inventory</h2>
<table id="allProducts">
    <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>DESC</th>
    <th>PRICE</th>
    <th>QUANTITY</th>
    </tr>
</table>
<h2>Add Product</h2>
  <form action=".insertInventory.php" method="post">
    <table id="addProduct">
      <tr><td>PRODUCT ID</td>
        <td><label>
          <input type="text" name="PRODUCT_ID">
        </label></td>
      </tr>

      <tr><td>PRODUCT NAME</td>
        <td><label>
          <input type="text" name="PRODUCT_NAME">
        </label></td>
      </tr>

      <tr><td>PRODUCT DESCRIPTION</td>
        <td><label>
          <input type="text" name="PRODUCT_DESCRIPTION">
        </label></td>
      </tr>

      <tr><td>PRICE</td>
        <td><label>
          <input type="text" name="PRICE">
        </label></td>
      </tr>

      <tr><td>QUANTITY</td>
        <td><label>
          <input type="text" name="QUANTITY">
        </label></td>
      </tr>

    </table>
      <input type="submit" name="INSERT" value="ADD STOCK">
  </form>
</body>
</html>