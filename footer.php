<!-- footer section starts -->
<footer class="footer-section footer-sm">
    <img src="assets/images/backgrounds/bg-2.webp" class="img-fluid footer-img" alt="" />
    <div class="custom-container">
        <div class="main-footer d-flex justify-content-center flex-col text-center">
            <div class="footer-logo-part">
                <img class="img-fluid logo" src="assets/images/logo/logo-dark.webp" alt="logo" />
                <p class="mx-auto">
                    Welcome to our online order website! Here, you can browse our wide
                    selection of products and place orders from the comfort of your
                    own home.
                </p>
                <div class="social-media-part">
                    <ul class="social-icon mx-auto">
                        <li>
                            <a href="#">
                                <i class="fa fa-facebook-f icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-brands fa-x-twitter icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa-brands fa-linkedin-in icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/dgl_throttlerz" target="_blank">
                                <i class="fa fa-instagram icon"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-youtube icon"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-footer-part">
            <div class="d-flex align-items-center justify-content-center">
                <h6>
                    <i class="fa fa-copyright"></i> Copyright <span id="current-year"></span> Madurai Theatre Centeen.
                    All rights Reserved.
                </h6>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->

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
    AOS.init({
        once: true,
    });
    window.addEventListener("load", AOS.refresh);

    //  handle Conact form submission
    function handleFormSubmit(
        event,
        formtype,
        $formBtnSpinner,
        $formBtnText,
        $formResponseText
    ) {
        event.preventDefault();

        $formBtnText.addClass("d-none");
        $formBtnSpinner.removeClass("d-none");

        const formData = new FormData(event.target);
        formData.append("formtype", formtype);

        $.ajax({
            url: "api/forms-submission.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                $formBtnText.removeClass("d-none");
                $formBtnSpinner.addClass("d-none");
                $(event.target)[0].reset();

                if (data.status === "success") {
                    $formResponseText
                        .addClass("text-white")
                        .html('<i class="fa fa-check"></i> ' + data.msg);
                } else {
                    $formResponseText
                        .addClass("text-danger")
                        .html('<i class="fa fa-times"></i> ' + data.msg);
                }

                setTimeout(() => {
                    $formResponseText.removeClass("text-white text-danger").html("");
                }, 3000);
            },
            error: function () {
                $formResponseText
                    .addClass("text-danger")
                    .html(
                        '<i class="fa fa-warning"></i> ' + "Error: Check Your Internet!."
                    );
                $formBtnText.removeClass("d-none");
                $formBtnSpinner.addClass("d-none");
                $(event.target)[0].reset();

                setTimeout(() => {
                    $formResponseText.removeClass("text-danger").html("");
                }, 3000);
            },
        });
    }

    window.getFormInfo = function (
        event,
        formName,
        formBtnSpinnerSelector,
        formBtnTextSelector,
        formResponseTextSelector
    ) {
        const $formBtnSpinner = $(formBtnSpinnerSelector);
        const $formBtnText = $(formBtnTextSelector);
        const $formResponseText = $(formResponseTextSelector);
        handleFormSubmit(
            event,
            formName,
            $formBtnSpinner,
            $formBtnText,
            $formResponseText
        );
    };

</script>
</body>

</html>