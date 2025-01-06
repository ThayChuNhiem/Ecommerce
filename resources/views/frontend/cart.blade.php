<!-- resources/views/frontend/cart.blade.php -->
@extends('backend.masterpage')

@section('title', 'Cart')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5" style="margin-top: 152px;">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Cart items will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="cart-subtotal">$0.00</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: 50,000 VND</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to Vietnam.</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="cart-total">$0.00</p>
                        </div>
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartSubtotal = document.getElementById('cart-subtotal');
            const cartTotal = document.getElementById('cart-total');
            const shippingCost = 50000; // Phí ship mặc định 50,000 VND

            let cart = JSON.parse(localStorage.getItem('cart')) || {};

            function updateCartDisplay() {
                cartItemsContainer.innerHTML = '';
                let subtotal = 0;

                for (const [id, product] of Object.entries(cart)) {
                    const total = product.price * product.quantity;
                    subtotal += total;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="${product.image}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="${product.name}">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">${product.name}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">${product.price} VND</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="updateQuantity('${id}', -1)">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="${product.quantity}" readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="updateQuantity('${id}', 1)">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">${total.toFixed(2)} VND</p>
                        </td>
                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeFromCart('${id}')">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                    `;
                    cartItemsContainer.appendChild(row);
                }

                cartSubtotal.textContent = `${subtotal.toFixed(2)} VND`;
                cartTotal.textContent = `${(subtotal + shippingCost).toFixed(2)} VND`;
            }

            window.updateQuantity = function(id, change) {
                if (cart[id]) {
                    cart[id].quantity += change;
                    if (cart[id].quantity <= 0) {
                        delete cart[id];
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartDisplay();
                }
            };

            window.removeFromCart = function(id) {
                if (cart[id]) {
                    delete cart[id];
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCartDisplay();
                }
            };

            updateCartDisplay();
        });
    </script>
@endsection