<?php include 'header.php'; ?>
<!-- cart section starts -->
<section class="empty-cart-section section-b-space" id="empty-cart-section">
    <div class="container">
        <div class="empty-cart-image">
            <div>
                <img class="img-fluid img" src="assets/images/svg/empty-cart.webp" alt="empty-cart" />
                <h2>It’s empty in your cart</h2>
                <h5>To browse more restaurants, visit the main page.</h5>
                <div class="d-flex gap-4"></div><a href="index.php#products"
                    class="btn theme-outline restaurant-btn mr-2">Our Products</a>
                <a href="orders.php" class="btn theme-outline restaurant-btn ml-2">Your Orders</a>
            </div>
        </div>
    </div>
</section>

<!-- cart section -->
<div class="product-details-content m-auto p-5" id="cart-items-section" style="max-width: 600px;">
    <div class="order-summery-section">
        <div class="checkout-detail">
            <h3 class="fw-semibold dark-text checkout-title">Cart Items</h3>
            <div class="order-summery-section mt-0">
                <div class="checkout-detail p-0">
                    <ul id="cart-items-list">
                        <!-- Cart items will be dynamically populated here -->
                    </ul>

                    <div class="grand-total">
                        <h6 class="fw-semibold dark-text">Sub Total</h6>
                        <h6 class="fw-semibold text-warning amount" id="to-pay-amount">$0</h6>
                    </div>
                    <style>
                        input[type="text"]#customer-name::placeholder,
                        input[type="number"]#seat-number::placeholder {
                            color: #999 !important;
                        }
                    </style>
                    <!-- Customer Details -->
                    <div class="customer-details mt-4">
                        <input type="text" id="customer-name" class="form-control mb-3" placeholder="Customer Name"
                            required />
                        <select id="screen-number" class="form-control mb-3" required>
                            <option value="">Select Screen</option>
                            <option value="Screen 1">Screen 1</option>
                            <option value="Screen 2">Screen 2</option>
                            <option value="Screen 3">Screen 3</option>
                            <option value="Screen 4">Screen 4</option>
                            <option value="Screen 5">Screen 5</option>
                        </select>
                        <input type="number" id="seat-number" class="form-control mb-3" placeholder="Seat Number"
                            min="1" max="100" required />
                    </div>
                </div>
            </div>
            <button id="confirm-order-button" class="btn theme-btn restaurant-btn w-100 rounded-2">Place Order</button>
        </div>
    </div>
</div>

<!-- Order Placed Section -->
<div class="account-part confirm-part" id="order-placed-section">
    <img class="img-fluid account-img w-25" src="assets/images/gif/order-placed.gif" alt="confirm" />
    <h3>Your order has been successfully placed</h3>
    <p>Sit and relax while your order is being worked on. It’ll take 5 min before you get it.</p>
    <div class="account-btn d-flex justify-content-center gap-2">
        <a href="orders.php" class="btn theme-btn mt-0">TRACK ORDER</a>
    </div>
</div>

<!-- Back to top button start  -->
<a href="#home" id="back-to-top-btn" class="text-white btn btn-dark btn-sm cursor-pointer"
    style="position: fixed;bottom:20px;right:20px; z-index:999;"><i class="fa fa-angle-up"></i></a>
<!-- Back to top button end  -->

<!-- Footer external File Links start -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/footer-accordion.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>
<script src="assets/js/custom-swiper.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/custom.js"></script> <!-- Custom Code for Order Functionality -->
<!-- Footer External File links end -->

<script>
    $(document).ready(function () {
        const dbName = "ShoppingCartDB";
        let db;

        const request = indexedDB.open(dbName, 1);

        request.onerror = function (event) {
            console.error("Database error:", event.target.errorCode);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
            checkCartIsEmpty().then(isEmpty => {
                if (isEmpty) {
                    showEmptyCartSection();
                } else {
                    showCartItemsSection();
                }
            }).catch(error => {
                console.error('Error checking cart:', error);
            });
        };

        request.onupgradeneeded = function (event) {
            db = event.target.result;
            db.createObjectStore("cart", { keyPath: "id" });
        };

        function checkCartIsEmpty() {
            return new Promise((resolve, reject) => {
                const transaction = db.transaction("cart", "readonly");
                const objectStore = transaction.objectStore("cart");
                const countRequest = objectStore.count();

                countRequest.onsuccess = function (event) {
                    resolve(event.target.result === 0);
                };

                transaction.onerror = function (event) {
                    reject(event.target.error);
                };
            });
        }

        function showEmptyCartSection() {
            $('#empty-cart-section').show();
            $('#cart-items-section').hide();
            $('#order-placed-section').hide();
        }

        function showCartItemsSection() {
            $('#empty-cart-section').hide();
            $('#cart-items-section').show();
            $('#order-placed-section').hide();

            const transaction = db.transaction(["cart"], "readonly");
            const objectStore = transaction.objectStore("cart");
            const request = objectStore.getAll();

            request.onsuccess = function (event) {
                const cartItems = event.target.result;
                const cartItemsList = $('#cart-items-list');
                cartItemsList.empty();

                cartItems.forEach(item => {
                    const itemHTML = `
                <li data-id="${item.id}">
                    <div class="horizontal-product-box d-flex pt-2 pb-2">
                        <div class="product-image">
                            <img src="${item.img}" style="height:60px;margin-right:10px;border-radius:4px;" alt="${item.name}"/>
                        </div>
                        <div class="product-content">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 style="width:70%;text-wrap:wrap;">${item.name}</h5>
                                <h6 class="product-price">${item.currency}${item.price}</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-md-2 mt-1 gap-1">
                                <div class="remove-item-btn text-danger" style="cursor:pointer;"><i class="fa fa-times"></i> <span>Remove</span></div>
                                <div class="plus-minus">
                                    <i class="fa fa-minus sub"></i>
                                    <input type="number" value="${item.quantity}" min="1" max="25" />
                                    <i class="fa fa-plus add"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                `;
                    cartItemsList.append(itemHTML);
                });

                calculateBillDetails(cartItems);
            };

            request.onerror = function (event) {
                console.error('Error fetching cart items:', event.target.error);
            };
        }

        // Event listener for increasing quantity
        $(document).on('click', '.plus-minus .add', function () {
            const productId = $(this).closest('li').data('id');
            const input = $(this).siblings("input");
            let value = parseInt(input.val());
            if (value < 25) {
                input.val(value + 1).change();
                updateQuantity(productId, value + 1);
            }
        });

        // Event listener for decreasing quantity
        $(document).on('click', '.plus-minus .sub', function () {
            const productId = $(this).closest('li').data('id');
            const input = $(this).siblings("input");
            let value = parseInt(input.val());
            if (value > 1) {
                input.val(value - 1).change();
                updateQuantity(productId, value - 1);
            }
        });

        function updateQuantity(productId, newQuantity) {
            const transaction = db.transaction(["cart"], "readwrite");
            const objectStore = transaction.objectStore("cart");
            const request = objectStore.get(productId);

            request.onsuccess = function (event) {
                const data = event.target.result;
                if (data) {
                    data.quantity = newQuantity;
                    objectStore.put(data);
                    showCartItemsSection();
                }
            };
        }
        // Event listener for remove item button
        $(document).on('click', '.remove-item-btn', function () {
            const productId = $(this).closest('li').data('id');

            const transaction = db.transaction(["cart"], "readwrite");
            const objectStore = transaction.objectStore("cart");
            objectStore.delete(productId);

            transaction.oncomplete = function () {
                checkCartIsEmpty().then(isEmpty => {
                    if (isEmpty) {
                        showEmptyCartSection();
                    } else {
                        showCartItemsSection();
                    }
                }).catch(error => {
                    console.error('Error checking cart:', error);
                });
            };
        });

        function calculateBillDetails(cartItems) {
            let subTotal = 0;
            cartItems.forEach(item => {
                subTotal += item.price * item.quantity;
            });
            const deliveryCharge = 0;
            const grandTotal = subTotal + deliveryCharge;

            $('#sub-total-amount').text(`${cartItems[0]?.currency || '$'}${subTotal}`);
            $('#to-pay-amount').text(`${cartItems[0]?.currency || '$'}${grandTotal}`);
        }

        $(document).on('click', '#confirm-order-button', function () {
            const customerName = $('#customer-name').val().trim();
            const screenNumber = $('#screen-number').val();
            const seatNumber = $('#seat-number').val();
            const transaction = db.transaction(["cart"], "readonly");
            const objectStore = transaction.objectStore("cart");
            const request = objectStore.getAll();

            request.onsuccess = function (event) {
                const cartItems = event.target.result;
                const total = cartItems.reduce((acc, curr) => acc + (curr.price * curr.quantity), 0);

                if (!customerName || !screenNumber || !seatNumber) {
                    alert("Please fill in all the customer details.");
                    return;
                }

                // Get unique order ID
                $.ajax({
                    url: 'api/api.php?action=generate_order_id',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const orderID = data.orderID;
                        // Append order ID and place order
                        placeOrder(cartItems, total, orderID, customerName, screenNumber, seatNumber);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error generating order ID:', textStatus, errorThrown);
                        alert("Error generating order ID. Please try again.");
                    }
                });
            };
        });

        function placeOrder(cartItems, total, orderID, customerName, screenNumber, seatNumber) {
            // Convert the cartItems array to JSON format
            const cartItemsJSON = JSON.stringify(cartItems);

            // Construct the URL with query parameters
            const url = `api/api.php?action=place_new_order&orderID=${orderID}&total=${total}&customerName=${customerName}&screenNumber=${screenNumber}&seatNumber=${seatNumber}&cartItems=${encodeURIComponent(cartItemsJSON)}`;

            // Send a GET request to the server
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        saveOrderHistory(cartItems, total, orderID);  // Save order history with order ID
                        clearCart();  // Clear the cart after placing the order
                        showOrderPlacedSection();
                    } else if (data.status === 'failed') {
                        alert("Order Not Placed: There is Some issue at our Side, Please try Later");
                    } else {
                        console.error('Error placing order:', data.msg);
                        alert("Error! Not enough information provided...");
                    }
                })
                .catch(error => {
                    console.error('Error placing order:', error);
                    alert("Error! Please Check Your Internet Connection...");
                });
        }



        // Function to save order history with order ID
        function saveOrderHistory(cartItems, total, orderID) {
            const dbName = "OrderHistoryDB";
            const objectStoreName = "order_history";

            const request = indexedDB.open(dbName, 2);

            request.onupgradeneeded = (event) => {
                const db = event.target.result;
                if (!db.objectStoreNames.contains(objectStoreName)) {
                    db.createObjectStore(objectStoreName, {
                        keyPath: 'id',
                        autoIncrement: true,
                    });
                }
            };

            request.onsuccess = (event) => {
                const db = event.target.result;
                const transaction = db.transaction([objectStoreName], 'readwrite');
                const orderHistoryObjectStore = transaction.objectStore(objectStoreName);

                const orderData = {
                    id: orderID,  // Use the provided order ID
                    items: cartItems,
                    total: total,
                    status: 'pending',  // Initial status
                    timestamp: new Date().toISOString(),
                    customerName: $('#customer-name').val().trim(),
                    screenNumber: $('#screen-number').val(),
                    seatNumber: $('#seat-number').val()
                };

                const requestToAdd = orderHistoryObjectStore.add(orderData);

                requestToAdd.onsuccess = function () {
                    console.log('Order history saved successfully.');
                };

                requestToAdd.onerror = function (error) {
                    console.error('Error saving order history:', error);
                };
            };

            request.onerror = function (error) {
                console.error("Error opening database:", error);
            };
        }

        // Function to clear the cart
        function clearCart() {
            const transaction = db.transaction(["cart"], "readwrite");
            const objectStore = transaction.objectStore("cart");
            objectStore.clear().onsuccess = function (event) {
            };
        }

        function showOrderPlacedSection() {
            $('#empty-cart-section').hide();
            $('#cart-items-section').hide();
            $('#order-placed-section').show();
        }
    });
</script>