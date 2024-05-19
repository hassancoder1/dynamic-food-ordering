<?php include 'header.php'; ?>
<style>
    body {
        background-color: #212521 !important;
    }
</style>

<!-- Orders section -->
<div class="product-details-content m-auto p-5" id="orders-section" style="max-width: 600px;">
    <div class="order-history-section">
        <div class="checkout-detail">
            <h3 class="fw-semibold text-white checkout-title">Hello, <span id="customer-name"></span></h3>
            <h3 class="fw-semibold text-white checkout-title">Pending Orders</h3>
            <div class="order-pending-list mt-0 mb-4">
                <!-- Pending orders will be dynamically populated here -->
            </div>
            <h3 class="fw-semibold text-white checkout-title">Your Previous Orders</h3>
            <div class="order-history-list mt-0">
                <!-- Orders will be dynamically populated here -->
            </div>
        </div>
    </div>
</div>
<div class="container table-responsive">
    <!-- <table class="table table-striped table-hover table-dark m-auto" style="max-width:600px;">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Date</th>
                <th scope="col">Items</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#00a7c9a3</td>
                <td>Apr-22-2024</td>
                <td>23</td>
                <td>$234</td>
                <td><span class="badge rounded-pill text-bg-success">Delivered</span></td>
            </tr>
            <tr>
                <td>#00a7c9a3</td>
                <td>Apr-22-2024</td>
                <td>23</td>
                <td>$234</td>
                <td><span class="badge rounded-pill text-bg-danger">Deleted</span></td>
            </tr>
            <tr>
                <td>#00a7c9a3</td>
                <td>Apr-22-2024</td>
                <td>23</td>
                <td>$234</td>
                <td><span class="badge rounded-pill text-bg-warning">Pending</span></td>
            </tr>
        </tbody>
    </table> -->
    <table class="table align-middle m-auto table-dark" style="max-width:600px;">
        <thead class="bg-light">
            <tr>
                <th>Info</th>
                <th class="col-1">Quantity</th>
                <th class="col-1">Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="d-flex align-items-left justify-content-start flex-column">
                        <div class="d-inline-flex gap-1"><img src="assets/images/product/item-1.webp" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <img src="assets/images/product/item-1.webp" alt="" style="width: 45px; height: 45px"
                                class="rounded-circle" />
                        </div>
                        <div>
                            <small class="fw-bolder mb-1">ID: #00a7c9a3</small><br>
                            <small>Apr-22-2024</small>
                        </div>
                    </div>
                </td>
                <td>34</td>
                <td>$53</td>
                <td><small class="badge rounded-pill text-bg-success">Delivered</small></td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-left justify-content-start flex-column">
                        <div class="d-inline-flex gap-1"><img src="assets/images/product/item-2.webp" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <img src="assets/images/product/item-2.webp" alt="" style="width: 45px; height: 45px"
                                class="rounded-circle" />
                        </div>
                        <div>
                            <small class="fw-bolder mb-1">ID: #00a7c9a3</small><br>
                            <small>Apr-22-2024</small>
                        </div>
                    </div>
                </td>
                <td>34</td>
                <td>$53</td>
                <td><small class="badge rounded-pill text-bg-danger">Deleted</small></td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-left justify-content-start flex-column">
                        <div class="d-inline-flex gap-1"><img src="assets/images/product/item-3.webp" alt=""
                                style="width: 45px; height: 45px" class="rounded-circle" />
                            <img src="assets/images/product/item-3.webp" alt="" style="width: 45px; height: 45px"
                                class="rounded-circle" />
                        </div>
                        <div>
                            <small class="fw-bolder mb-1">ID: #00a7c9a3</small><br>
                            <small>Apr-22-2024</small>
                        </div>
                    </div>
                </td>
                <td>34</td>
                <td>$53</td>
                <td><small class="badge rounded-pill text-bg-warning">Pending</small></td>
            </tr>
        </tbody>
    </table>
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
        const dbName = "OrderHistoryDB";
        let db;
        const customerName = "John Doe"; // Replace this with actual customer name if available
        $('#customer-name').text(customerName);

        const request = indexedDB.open(dbName, 2);

        request.onerror = function (event) {
            console.error("Database error:", event.target.errorCode);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
            showOrderHistory();
        };

        request.onupgradeneeded = function (event) {
            db = event.target.result;
            if (!db.objectStoreNames.contains("order_history")) {
                db.createObjectStore("order_history", {
                    keyPath: 'id',
                    autoIncrement: true,
                });
            }
        };

        function showOrderHistory() {
            const transaction = db.transaction(["order_history"], "readonly");
            const objectStore = transaction.objectStore("order_history");
            const request = objectStore.getAll();

            request.onsuccess = function (event) {
                const orders = event.target.result.sort((a, b) => b.id - a.id); // Sort in descending order
                const orderHistoryList = $('.order-history-list');
                const orderPendingList = $('.order-pending-list');
                orderHistoryList.empty();
                orderPendingList.empty();

                orders.forEach(order => {
                    const orderHTML = `
                        <div class="order-container mb-4">
                            <h5 class="fw-semibold text-white">Order #${order.id}</h5>
                            <ul class="order-items-list list-unstyled">
                                ${order.items.map(item => `
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <img src="${item.img}" alt="${item.name}" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="item-details text-secondary flex-grow-1 ml-3">
                                            <span>${item.name} - ${item.quantity}</span>
                                        </div>
                                        <span class="text-white">${item.currency}${item.price * item.quantity}</span>
                                    </li>
                                `).join('')}
                            </ul>
                            <div class="order-subtotal mt-2">
                                <span class="fw-semibold text-secondary">Subtotal:</span>
                                <span class="text-warning">${order.items[0].currency}${order.total}</span>
                            </div>
                        </div>
                    `;
                    if (order.status === 'preparing') {
                        orderPendingList.append(orderHTML);
                    } else {
                        orderHistoryList.append(orderHTML);
                    }
                });
            };

            request.onerror = function (event) {
                console.error('Error fetching order history:', event.target.error);
            };
        }
    });
</script>