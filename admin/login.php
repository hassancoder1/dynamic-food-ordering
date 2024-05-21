<?php include '../functions.php' ?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - MTC Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/tailwind.output.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="assets/js/init-alpine.js"></script>
    <script src="https://kit.fontawesome.com/c0ac63cffd.js" crossorigin="anonymous"></script>
</head>

<body>
    <form onsubmit="getFormInfo(event,
    'loginform','.login-form-btn-spinner','.login-form-btn-text','.login-form-response-text')">
        <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
            <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <div class="flex flex-col overflow-y-auto md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                            src="assets/img/login-office.jpeg" alt="Office" />
                        <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                            src="assets/img/login-office-dark.jpeg" alt="Office" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                                Login
                            </h1>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Username</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="eg. 'admin123abc'" name="username" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    placeholder="eg. '9fdih8dXwf8TrAa'" name="password" type="password" required />
                            </label>

                            <button type="submit"
                                class="flex justify-center items-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">

                                <svg class="w-5 h-5 mx-auto text-white animate-spin login-form-btn-spinner hidden"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">

                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4">
                                    </circle>

                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">

                                    </path>

                                </svg>

                                <span class="login-form-btn-text text-white">Log in</span>
                            </button>
                            <p class="login-form-response-text mt-4 font-medium text-sm"></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }
            function getCookie(name) {
                let cookieArr = document.cookie.split(";");

                for (let i = 0; i < cookieArr.length; i++) {
                    let cookiePair = cookieArr[i].split("=");

                    if (name === cookiePair[0].trim()) {
                        return decodeURIComponent(cookiePair[1]);
                    }
                }

                return null;
            }

            // Redirect to login.php if auth_ cookie does not exist
            if (getCookie('auth_')) {
                window.location.href = 'index.php';
            }


            function handleFormSubmit(event, formtype, $formBtnSpinner, $formBtnText, $formResponseText) {
                event.preventDefault();

                $formBtnText.addClass("hidden");
                $formBtnSpinner.removeClass("hidden");

                const formData = new FormData(event.target);
                formData.append('formtype', formtype);

                $.ajax({
                    url: '../api/forms-submission.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data) {
                        $formBtnText.removeClass("hidden");
                        $formBtnSpinner.addClass("hidden");
                        $(event.target)[0].reset();

                        if (data.status === 'success') {
                            $formResponseText.addClass("text-green-500").html('<i class="fa fa-check"></i> ' + data.msg);
                            setCookie('auth_', '<?php echo $auth; ?>', 7);
                            window.location.href = 'index.php';
                        } else {
                            $formResponseText.addClass("text-red-500").html('<i class="fa fa-times"></i> ' + data.msg);
                        }

                        setTimeout(() => {
                            $formResponseText.removeClass("text-green-500 text-red-500").html('');
                        }, 3000);
                    },
                    error: function () {
                        $formResponseText.addClass("text-red-500").html('<i class="fa fa-warning"></i> ' + "Error: Check Your Internet!.");
                        $formBtnText.removeClass("hidden");
                        $formBtnSpinner.addClass("hidden");
                        $(event.target)[0].reset();

                        setTimeout(() => {
                            $formResponseText.removeClass("text-red-500").html('');
                        }, 3000);
                    }
                });
            }

            window.getFormInfo = function (event, formName, formBtnSpinnerSelector, formBtnTextSelector, formResponseTextSelector) {
                const $formBtnSpinner = $(formBtnSpinnerSelector);
                const $formBtnText = $(formBtnTextSelector);
                const $formResponseText = $(formResponseTextSelector);
                handleFormSubmit(event, formName, $formBtnSpinner, $formBtnText, $formResponseText);
            }
        });
    </script>
</body>

</html>