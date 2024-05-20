<?php include 'header.php'; ?>
<h1 id="home"></h1>
<style>
    .header,
    .footer {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
    }

    .header h1,
    .footer a {
        text-align: center;
        color: #ffc107;
    }

    .main {
        padding: 20px 0;
    }

    .order-status img {
        display: block;
        margin: 20px auto;
    }

    .order-list ol {
        counter-reset: order-counter;
    }

    .order-list ol li {
        counter-increment: order-counter;
        position: relative;
        padding-left: 2rem;
    }

    .order-list ol li::before {
        content: counter(order-counter) ". ";
        position: absolute;
        left: 0;
    }

    .order-status,
    .previous-orders {
        margin-bottom: 30px;
    }

    .order-items-list img {
        width: 40px;
        height: 40px;
        border-radius: 100%;
    }

    .order-items-list span {
        color: white;
    }
</style>

<!-- Header -->
<header class="header">
    <div class="container">
        <h1 class="display-4">Your Orders</h1>
    </div>
</header>

<!-- Main Content -->
<main class="main text-white">
    <div class="container mt-5">
        <section class="order-status">
            <img src="assets/images/gif/an.gif" alt="" class="img-fluid" style="width: 180px;">

            <h2 class="display-6">Hello, <span id="customer-name" class="fw-medium text-warning"></span></h2>
            <p class="mb-2">Please stay on this page to see your order status.</p>
            <div class="order-list">
                <ol class="list-group bg-dark">
                    <!-- preparing Orders List -->
                </ol>
            </div>
        </section>

        <section class="previous-orders mt-4">
            <h2 class="display-8 mb-2">Your Previous Orders</h2>
            <div class="order-list">
                <ol class="list-group bg-dark">
                    <!-- Previous Orders List -->
                </ol>
            </div>
        </section>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <!-- Back to top button -->
        <a href="#home" id="back-to-top-btn" class="btn btn-dark btn-sm">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>

<!-- JavaScript files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    $(document).ready(function () {
        const dbName = "OrderHistoryDB";
        let db;

        const request = indexedDB.open(dbName, 2);

        request.onerror = function (event) {
            console.error("Database error:", event.target.errorCode);
        };

        request.onsuccess = function (event) {
            db = event.target.result;
            showOrderHistory();
            setInterval(checkAndUpdateOrderStatus, 5000); // Check order status every 5 seconds
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

        function formatDate(timestamp) {
            const now = moment();
            const date = moment(timestamp);
            const diff = now.diff(date, 'minutes');
            console.log(diff);
            if (diff < 1) {
                return 'Just now';
            } else if (diff < 60) {
                return `${diff} minutes ago`;
            } else {
                return date.format('MMM-DD-YYYY - hh:mm A');
            }
        }

        function showOrderHistory() {
            const transaction = db.transaction(["order_history"], "readonly");
            const objectStore = transaction.objectStore("order_history");
            const request = objectStore.getAll();

            request.onsuccess = function (event) {
                const orders = event.target.result.sort((a, b) => b.id - a.id); // Sort in descending order
                const orderHistoryList = $('.previous-orders .order-list ol');
                const orderPreparingList = $('.order-status .order-list ol');
                orderHistoryList.empty();
                orderPreparingList.empty();

                let customerName = '';

                orders.forEach(order => {
                    if (order.status === 'preparing' && !customerName) {
                        customerName = order.customerName;
                    }
                    console.log(order);
                    let orderStatusStyle;
                    if (order.status === 'preparing') {
                        orderStatusStyle = 'warning';
                    } else if (order.status === 'delivered') {
                        orderStatusStyle = 'success';
                    } else if (order.status === 'failed') {
                        orderStatusStyle = 'danger';
                    } else if (order.status === 'pending') {
                        orderStatusStyle = 'secondary';
                    } else {
                        orderStatusStyle = 'primary';
                    }

                    const orderItemsHTML = order.items.map(item => `
                    <li class="d-flex justify-content-between align-items-center mb-2">
                        <img src="${item.img}" alt="${item.name}" class="img-fluid">
                        <div class="item-details text-secondary flex-grow-1 mx-2">
                            <span>${item.name} - ${item.quantity} x ${item.currency}${item.price}</span>
                        </div>
                        <span class="text-white">${item.currency}${item.price * item.quantity}</span>
                    </li>
                `).join('');

                    const orderHTML = `
                    <li class="list-group-item">
                        <div>
                            <h5 class="fw-semibold text-white">Order #${order.id} - ${formatDate(order.date)}</h5>
                            <ul class="list-unstyled order-items-list">
                                ${orderItemsHTML}
                            </ul>
                            <div class="order-subtotal mt-2"> 
                            <div class="text-white">
                                <span class="fw-semibold text-white">Subtotal:</span>
                                <span class="text-warning fs-5 fw-bold">${order.items[0].currency}${order.total}</span> || 
                                <span class="fw-semibold text-white">Order Status: </span>
                                <span style="font-size:13px;" class="text-capitalize badge rounded-pill text-bg-${orderStatusStyle}">${order.status}</span> || <span class="fw-semibold text-white">Screen Number: ${order.screenNumber}</span> || <span class="fw-semibold text-white">Seat Number: ${order.seatNumber}</span>
                            </div>
                            </div>
                        </div>
                    </li>
                        `;

                    if (order.status === 'preparing') {
                        orderPreparingList.append(orderHTML);
                    } else {
                        if (!customerName && order.customerName) {
                            customerName = order.customerName;
                        }
                        orderHistoryList.append(orderHTML);
                    }
                });

                $('#customer-name').text(customerName);
            };

            request.onerror = function (event) {
                console.error('Error fetching order history:', event.target.error);
            };
        }

        function updateOrderStatus(orderId, updatedStatus) {
            const transaction = db.transaction(["order_history"], "readwrite");
            const objectStore = transaction.objectStore("order_history");
            const getRequest = objectStore.get(orderId);

            getRequest.onsuccess = function (event) {
                const order = event.target.result;
                if (order) {
                    order.status = updatedStatus;
                    const updateRequest = objectStore.put(order);

                    updateRequest.onsuccess = function () {
                        showOrderHistory();
                    };

                    updateRequest.onerror = function (event) {
                        console.error('Error updating order status:', event.target.error);
                    };
                } else {
                    console.error('Order not found');
                }
            };

            getRequest.onerror = function (event) {
                console.error('Error retrieving order:', event.target.error);
            };
        }

        function checkAndUpdateOrderStatus() {
            const transaction = db.transaction(["order_history"], "readonly");
            const objectStore = transaction.objectStore("order_history");
            const request = objectStore.getAll();

            request.onsuccess = function (event) {
                const orders = event.target.result;

                orders.forEach(order => {
                    $.ajax({
                        url: `api/api.php?action=get_order_status&order_id=${order.id}`, // Your API endpoint
                        method: 'GET',
                        success: function (response) {
                            if (response.status && response.status !== order.status) {
                                updateOrderStatus(order.id, response.status);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching order status:', error);
                        }
                    });
                });
            };

            request.onerror = function (event) {
                console.error('Error retrieving orders:', event.target.error);
            };
        }
    });
</script>
</body>

</html>