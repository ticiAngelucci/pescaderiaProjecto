<!DOCTYPE html>
@include('header')
@include('navbar')

<html>

<head>
    <title>Carrito de Compras</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 800px;
        margin: 20px auto;

    }

    h1 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        background-color: #f4f4f4;
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ccc;
    }

    table th {
        background-color: #f4f4f4;
    }

    .cart-total {
        text-align: right;
        margin-top: 20px;
        font-weight: bold;

    }

    .cart-total span {
        color: #333;
    }

    .quantity {
        width: 60px;
    }

    .btn {
        display: inline-block;
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #45a049;
    }
    </style>
    <script>
    function updateQuantity(row, price) {
        var quantityInput = row.querySelector(".quantity");
        var quantity = parseInt(quantityInput.value);
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            quantityInput.value = 1;
        }
        var totalCell = row.querySelector(".total");
        var total = quantity * price;
        totalCell.textContent = "$" + total.toFixed(2);
        updateCartTotal();
    }

    function updateCartTotal() {
        var rows = document.querySelectorAll(".cart-item");
        var total = 0;
        rows.forEach(function(row) {
            var totalCell = row.querySelector(".total");
            var rowTotal = parseFloat(totalCell.textContent.replace("$", ""));
            total += rowTotal;
        });
        var cartTotal = document.querySelector(".cart-total span");
        cartTotal.textContent = "$" + total.toFixed(2);
    }
    </script>
</head>

<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="cart-item">
                    <td>Producto 1</td>
                    <td>$19.99</td>
                    <td>
                        <input type="number" class="quantity" value="1" min="1"
                            onchange="updateQuantity(this.parentNode.parentNode, 19.99)">
                    </td>
                    <td class="total">$19.99</td>
                </tr>
                <tr class="cart-item">
                    <td>Producto 2</td>
                    <td>$9.99</td>
                    <td>
                        <input type="number" class="quantity" value="2" min="1"
                            onchange="updateQuantity(this.parentNode.parentNode, 9.99)">
                    </td>
                    <td class="total">$19.98</td>
                </tr>
                <tr class="cart-item">
                    <td>Producto 3</td>
                    <td>$14.99</td>
                    <td>
                        <input type="number" class="quantity" value="1" min="1"
                            onchange="updateQuantity(this.parentNode.parentNode, 14.99)">
                    </td>
                    <td class="total">$14.99</td>
                </tr>
            </tbody>
        </table>
        <div class="cart-total">
            Total: <span>$54.96</span>
        </div>
        <div class="checkout">
            <a href="#" class="btn">Realizar pago</a>
        </div>
    </div>
</body>

</html>