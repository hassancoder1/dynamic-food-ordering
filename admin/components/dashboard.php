<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Dashboard
</h2>
<!-- Cards -->
<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                </path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Orders
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="totalOrders"></p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Earnings
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="totalEarnings"></p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                </path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Item Sales
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="totalSales"></p>
        </div>
    </div>
    <!-- Card -->
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        <div class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                Pending Orders
            </p>
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="totalPendingOrders"></p>
        </div>
    </div>
</div>

<!-- New Table -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" id="ordersTableBody">
            </tbody>
        </table>
    </div>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3" id="resultsCount"></span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center" id="pagination">
                    <label for="pageInput" class="block text-sm font-medium text-white-700">Go to page</label>
                    <input type="number" id="pageInput"
                        class="block py-1 border-2 mt-1 mx-2 text-center text-sm dark:border-gray-600 dark:bg-gray-700 border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        style="width:35px;" placeholder="1">
                </ul>
                <div class="ml-4">

                </div>
            </nav>
        </span>
    </div>
</div>

<script>
    $(document).ready(function () {
        fetchOrders(<?php echo $value1; ?>);
        setInterval(() => {
            fetchOrders(<?php echo $value1; ?>);
        }, 10000);

        function formatDate(timestamp) {
            const now = moment();
            const date = moment(timestamp);
            const diff = now.diff(date, 'minutes');
            if (diff < 1) {
                return 'Just now';
            } else if (diff < 60) {
                return `${diff} minutes ago`;
            } else {
                return date.format('MMM-DD-YYYY - hh:mm A');
            }
        }

        function getStatusClass(status) {
            switch (status.toLowerCase()) {
                case "preparing":
                    return "text-orange-700 rounded-full bg-orange-100 dark:text-white dark:bg-orange-600";
                case "delivered":
                    return "text-green-700 rounded-full bg-green-100 dark:bg-green-700 dark:text-green-100";
                case "denied":
                    return "text-red-700 rounded-full bg-red-100 dark:text-red-100 dark:bg-red-700";
                case "pending":
                    return "text-gray-700 rounded-full bg-gray-100 dark:text-gray-100 dark:bg-gray-700";
                default:
                    return "";
            }
        }

        function fetchOrders(page) {
            $.ajax({
                url: '../api/api.php?action=get_formatted_orders_data&page=' + page,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Update HTML content with the fetched totals
                    $('#totalOrders').text(data.total_orders);
                    $('#totalEarnings').text(data.total_earnings);
                    $('#totalPendingOrders').text(data.total_pending_orders);
                    $('#totalSales').text(data.total_sales);

                    // Calculate the current range of orders being displayed
                    const start = (page - 1) * 10 + 1;
                    const end = Math.min(page * 10, data.total_orders);
                    $('#resultsCount').text(`Showing ${start} - ${end} of ${data.total_orders}`);

                    // Populate orders table
                    const tbody = $("#ordersTableBody");
                    tbody.empty();
                    data.orders.forEach((order) => {
                        tbody.append(`
                        <tr class="cursor-pointer text-gray-700 dark:text-gray-400" onclick="loadComponent('view-order','${order.order_id}')">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full" src="../${order.items[0].item_img}" alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">ID: #${order.order_id}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400" title="Customer Name">
                                            ${order.customer_name} - ( ${order.quantity_per_order} item(s) )
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span>${order.items[0].currency}</span><span>${order.total}</span>
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight ${getStatusClass(order.order_status)}">
                                    ${order.order_status}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">${formatDate(order.timestamp)}</td>
                        </tr>
                    `);
                    });

                    // Handle input field for direct page navigation
                    $('#pageInput').off('keypress').on('keypress', function (e) {
                        if (e.which === 13) { // Enter key pressed
                            const pageNumber = parseInt($(this).val());
                            if (pageNumber > 0 && pageNumber <= data.total_pages) {
                                fetchOrders(pageNumber);
                            } else {
                                alert('Invalid page number');
                            }
                        }
                    });
                },
                error: function () {
                    console.error('Failed to fetch orders.');
                }
            });
        }
    });
</script>