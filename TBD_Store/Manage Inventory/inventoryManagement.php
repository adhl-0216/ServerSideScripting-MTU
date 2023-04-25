<?php
include "../css/myHeader.html";?>
<body>
<h1>Inventory Management</h1>
<h2>Current Inventory</h2>
<table id="allProducts" class="">
    <tr>
    <th>TYPE</th>
    <th>ID</th>
    <th>NAME</th>
    <th>DESCRIPTION</th>
    <th>UK SIZE</th>
    <th>PRICE(&euro;)</th>
    <th>QUANTITY</th>
    <th>OPTIONS</th>
    </tr>
</table>
<h2>Add Product</h2>
  <form method="post">
    <table id="addProduct">
      <tr><td>PRODUCT TYPE</td>
        <td>
          <label>
            <select name="PRODUCT_TYPE">
              <option value="FW">Footwear</option>
              <option value="JR">Jersey</option>
              <option value="EQ">Equipment</option>
              <option value="AC">Accessories</option>
            </select>
          </label></td>
      </tr>

      <tr><td>PRODUCT NAME</td>
        <td><label>
          <input type="text" name="PRODUCT_NAME" required>
        </label></td>
      </tr>

      <tr><td>PRODUCT DESCRIPTION</td>
          <td><label>
              <input type="text" name="PRODUCT_DESCRIPTION">
          </label></td>
      </tr>

    <tr><td>UK SIZE</td>
        <td><label>
            <input type="number" name="UK_SIZE" min="5.5" step="0.5" max="12" required>
        </label></td>
    </tr>

      <tr><td>PRICE</td>
        <td><label>
          <input type="number" name="PRICE" min="0">
        </label></td>
      </tr>

      <tr><td>QUANTITY</td>
        <td><label>
          <input type="number" name="QUANTITY" step="1" pattern="[0-9]" min="0" required>
        </label></td>
      </tr>

    </table>
      <input type="submit" name="INSERT" value="ADD STOCK">
  </form>
</body>
<script async src=".inventoryManagement.js"></script>
<?php include "../css/myFooter.html";?>