<?php include 'header.php'; ?>
<!-- Header section start -->
<header class="header-light">
    <div class="custom-container">
        <nav class="navbar navbar-expand-lg p-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-bars"></i>
                </span>
            </button>
            <a href="index.php">
                <img class="img-fluid logo" style="transition: 0.3s al; ease;" data-aos="fade-up"
                    src="assets/images/logo/logo-dark.webp" alt="logo" />
            </a>
            <div class="nav-option location-btn order-md-2">
                <div class="dropdown-button">
                    <a href="cart.php" class="cart-button">
                        <span id="cart-count"></span>
                        <i class="fa fa-cart-shopping cart-bag"></i>
                    </a>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button class="navbar-toggler btn-close" id="offcanvas-close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1">
                        <li class="nav-item dropdown mega-menu">
                            <a class="nav-link" href="#about" role="button">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#reviews">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- Header Section end -->

<!-- home section start -->
<section class="pt-4 home3" id="home">
    <div class="custom-container mt-5 pt-5">
        <div class="position-relative">
            <img src="assets/images/backgrounds/bg-2.webp" class="img-fluid bg-home-img" alt="" />
            <div class="home-content">
                <div class="row w-100 h-100">
                    <div class="col-sm-6 col-12">
                        <div class="home-left-content">
                            <label>Tasty 😋| Faster Delivery</label>
                            <h2>Made with love,<br />Savored with interest.</h2>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Quaerat eos aut id distinctio rem iure odio sunt velit rerum
                                deserunt?
                            </p>
                            <div class="search-section">
                                <a class="btn theme-btn mt-0" href="#products" role="button">View Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 d-sm-block d-none">
                        <div class="home-right position-relative">
                            <img src="assets/images/mobile.webp" class="img-fluid base-phone" alt="" />
                            <div class="animated-img">
                                <div class="food1">
                                    <img src="assets/images/food1.webp" data-aos="fade-down" data-aos-easing="linear" ]
                                        data-aos-anchor-placement="top-center" data-aos-duration="1200"
                                        class="img-fluid" alt="" />
                                </div>
                                <div class="food2">
                                    <img src="assets/images/food2.webp" data-aos-duration="1200" data-aos="fade-down"
                                        data-aos-anchor-placement="bottom-center" class="img-fluid" alt="" />
                                </div>
                                <div class="food3">
                                    <img src="assets/images/food3.webp" data-aos="fade-down" data-aos-easing="linear"
                                        data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000"
                                        class="img-fluid" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- home section end -->

<!-- about section starts -->
<section class="section-b-space" id="about">
    <div class="container">
        <div class="row g-3">
            <div class="col-xl-7">
                <div class="title animated-title">
                    <div class="loader-line"></div>
                    <h2 class="mb-sm-3 mb-2">
                        What is <br />
                        Madurai Theatre Centeen ?
                    </h2>
                    <p class="content-color">
                        Welcome to our online order website! Here, you can browse our
                        wide selection of products and place orders from the comfort of
                        your own home. Whether you're looking for groceries,
                        electronics, or gifts, we have you covered. With easy
                        navigation, secure payment options, and fast delivery.
                    </p>

                    <p class="pt-2 content-color">
                        we strive to make your online shopping experience as seamless as
                        possible. Explore our website today and discover the convenience
                        of ordering online!
                    </p>

                    <p class="pt-2 content-color">
                        So why wait? Start shopping on our online order website today
                        and experience the ultimate convenience of online shopping!"
                    </p>
                </div>
                <div class="about-image-part">
                    <div class="row g-sm-3 g-2">
                        <div class="col-xl-3 col-lg-3 col-sm-6 col-6">
                            <div class="about-images ratio_square">
                                <img class="bg-size img" src="assets/images/services/1.webp" alt="1" />
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6 col-6">
                            <div class="about-images ratio_square">
                                <img class="bg-size img" src="assets/images/services/2.webp" alt="2" />
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6 col-6">
                            <div class="about-images ratio_square">
                                <img class="bg-size img" src="assets/images/services/3.webp" alt="3" />
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6 col-6">
                            <div class="about-images ratio_square">
                                <img class="bg-size img" src="assets/images/services/4.webp" alt="4" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 d-xl-inline-block d-none">
                <div class="about-images h-100">
                    <img class="img-fluid img h-100" src="assets/images/services/5.webp" alt="2" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about section end -->

<!-- service section start -->
<section class="service-section section-b-space">
    <div class="container">
        <div class="home-features-list row gy-xl-0 gy-md-4 gy-3 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">
            <div>
                <div class="home-features-box">
                    <img class="img-fluid icon" src="assets/images/svg/burger.webp" alt="routing" />
                    <div class="home-features-content">
                        <h5 class="text-white">Tasty 😋</h5>
                        <h6>Fresh, flavorful food. Delivered</h6>
                    </div>
                </div>
            </div>
            <div>
                <div class="home-features-box">
                    <img class="img-fluid icon" src="assets/images/svg/3d-rotate.webp" alt="3d-rotate" />
                    <div class="home-features-content">
                        <h5 class="text-white">Easiest Order</h5>
                        <h6>Easy and hussle free order online process</h6>
                    </div>
                </div>
            </div>
            <div>
                <div class="home-features-box">
                    <img class="img-fluid icon" src="assets/images/svg/delivery.webp" alt="truck" />
                    <div class="home-features-content">
                        <h5 class="text-white">Most Delivery</h5>
                        <h6>we ensure your food is delivered swiftly</h6>
                    </div>
                </div>
            </div>
            <div>
                <div class="home-features-box">
                    <img class="img-fluid icon" src="assets/images/svg/credit-card.webp" alt="truck" />
                    <div class="home-features-content">
                        <h5 class="text-white">Various Payment</h5>
                        <h6>Various payment options to make order seamless</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service section end -->

<!-- title start -->
<div class="container" id="products">
    <div class="title-center">
        <h2>Tasty food to your seat <span> in just a few minutes.</span></h2>
    </div>
</div>
<!-- title end -->

<!-- Products section starts -->
<!-- menu section starts -->
<section class="menu-section section-b-space">
    <div class="container">
        <div class="row g-3">
            <div class="col-xl-4 col-sm-6">
                <div class="pharmacy-product-box" data-id="99539297-a327-4d10-9d70-4e55d3c64d02">
                    <div>
                        <div class="pharmacy-product-img bg-white">
                            <img class="bg-img img" src="assets/images/product/item-1.webp" alt="p1" />
                        </div>
                    </div>
                    <div class="pharmacy-product-details">
                        <h6 class="content-color">Maxican, Italian</h6>
                        <h5 class="product-name dark-text">Ultimate Loaded cheese Pizza</h5>
                        <div class="d-flex align-items-center justify-content-between my-1">
                            <h5 class="fw-medium theme-color">
                                <span class="currency">$</span>
                                <span class="price">12</span>
                                <span class="content-color">
                                    <del>
                                        <span>$</span>
                                        <span>20</span>
                                    </del>
                                </span>
                            </h5>
                        </div>
                        <div class="bottom-panel d-flex align-items-center justify-content-between gap-1">
                            <div class="plus-minus">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa fa-minus sub"></i>
                                    <input type="number" value="1" min="1" max="25" />
                                    <i class="fa fa-plus add"></i>
                                </div>
                            </div>
                            <a class="btn cursor-pointer theme-outline cart-btn rounded-2">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="pharmacy-product-box" data-id="7fc60a53-faa4-4bc1-a956-221ecdeed7e4">
                    <div>
                        <div class="pharmacy-product-img bg-white">
                            <img class="bg-img img" src="assets/images/product/item-2.webp" alt="p1" />
                        </div>
                    </div>
                    <div class="pharmacy-product-details">
                        <h6 class="content-color"> dolor sit.</h6>
                        <h5 class="product-name dark-text">cheese Pizza</h5>
                        <div class="d-flex align-items-center justify-content-between my-1">
                            <h5 class="fw-medium theme-color">
                                <span class="currency">$</span>
                                <span class="price">12</span>
                                <span class="content-color">
                                    <del>
                                        <span>$</span>
                                        <span>20</span>
                                    </del>
                                </span>
                            </h5>
                        </div>
                        <div class="bottom-panel d-flex align-items-center justify-content-between gap-1">
                            <div class="plus-minus">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa fa-minus sub"></i>
                                    <input type="number" value="1" min="1" max="25" />
                                    <i class="fa fa-plus add"></i>
                                </div>
                            </div>
                            <a class="btn cursor-pointer theme-outline cart-btn rounded-2">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="pharmacy-product-box" data-id="13e8b93f-7d5b-42d5-ac4f-d90c6fde2bca">
                    <div>
                        <div class="pharmacy-product-img bg-white">
                            <img class="bg-img img" src="assets/images/product/item-3.webp" alt="p1" />
                        </div>
                    </div>
                    <div class="pharmacy-product-details">
                        <h6 class="content-color">Lorem, ipsum dolor.</h6>
                        <h5 class="product-name dark-text">Lorem ipsum dolor sit amet.</h5>
                        <div class="d-flex align-items-center justify-content-between my-1">
                            <h5 class="fw-medium theme-color">
                                <span class="currency">$</span>
                                <span class="price">12</span>
                                <span class="content-color">
                                    <del>
                                        <span>$</span>
                                        <span>20</span>
                                    </del>
                                </span>
                            </h5>
                        </div>
                        <div class="bottom-panel d-flex align-items-center justify-content-between gap-1">
                            <div class="plus-minus">
                                <div class="d-flex align-items-center justify-content-between">
                                    <i class="fa fa-minus sub"></i>
                                    <input type="number" value="1" min="1" max="25" />
                                    <i class="fa fa-plus add"></i>
                                </div>
                            </div>
                            <a class="btn cursor-pointer theme-outline cart-btn rounded-2">Add Cart</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- menu section end -->
<!-- Products section end -->

<!-- brand section starts -->
<section class="brand-section">
    <div class="container">
        <div class="title">
            <h2>Brand For You</h2>
            <div class="loader-line"></div>
            <div class="sub-title">
                <p>
                    Browse out top brands here to discover different food cuision.
                </p>
            </div>
        </div>
        <div class="theme-arrow">
            <div class="swiper brands-logo">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-1.webp"
                                    alt="brand-1" />
                            </a>
                            <a>
                                <h4>La Pino’z</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-2.webp"
                                    alt="brand-2" />
                            </a>
                            <a>
                                <h4>Mc'd</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-3.webp"
                                    alt="brand-3" />
                            </a>
                            <a>
                                <h4>Starbucks</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-4.webp"
                                    alt="brand-2" />
                            </a>
                            <a>
                                <h4>Pizza Hut</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-5.webp"
                                    alt="brand-2" />
                            </a>
                            <a>
                                <h4>Wendy's</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-6.webp"
                                    alt="brand-6" />
                            </a>
                            <a>
                                <h4>Burger King</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-7.webp"
                                    alt="brand-7" />
                            </a>
                            <a>
                                <h4>Subway</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-8.webp"
                                    alt="brand-8" />
                            </a>
                            <a>
                                <h4>Domino's</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-9.webp"
                                    alt="brand-9" />
                            </a>
                            <a>
                                <h4>Taco Bell</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-10.webp"
                                    alt="brand-10" />
                            </a>
                            <a>
                                <h4>Chipotle</h4>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-box">
                            <a class="food-brands">
                                <img class="img-fluid brand-img" src="assets/images/brands/brand-11.webp"
                                    alt="brand-11" />
                            </a>
                            <a>
                                <h4>KFC</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next brand-next">
                <i class="fa fa-angle-right"></i>
            </div>
            <div class="swiper-button-prev brand-prev">
                <i class="fa fa-angle-left"></i>
            </div>
        </div>
    </div>
    <br /><br /><br /><br />
</section>
<!-- brand section end -->

<!-- testimonial section starts -->
<section class="section-b-space testimonial-section" id="reviews">
    <div class="container">
        <div class="faq-title">
            <h2>Our Client Feedback</h2>
        </div>
        <div class="swiper testimonial mb-xl-5 mb-sm-4 mb-3">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                I was so impressed with my breakfast this morning! I tried
                                the Fried Green Tomato Benedict and my boyfriend got the
                                Crab Cakes Benedict
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-1.webp" alt="p1" />
                                <h5 class="fw-semibold dark-text mt-2">Gunjan Puri</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                We both finished our whole plates and were so impressed with
                                the quality of the food and the short amount of time it took
                                to receive it.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-2.webp" alt="p2" />
                                <h5 class="fw-semibold dark-text mt-2">Emily James</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                This is always our breakfast stop before heading home from
                                vacation. Always delicious. Always great service. Always
                                worth the stop.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-3.webp" alt="p3" />
                                <h5 class="fw-semibold dark-text mt-2">Alexa Diaz</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                The absolute best red sauce. Weather on Pizza or Pasta, it’s
                                honestly delicious. Portions are huge and the staff is
                                extremely friendly and courteous.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-4.webp" alt="p4" />
                                <h5 class="fw-semibold dark-text mt-2">Nicole Cooper</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                It was a fantastic breakfast. Like a delicious homestyle
                                rural savoury breakfast. I enjoyed the entire experience and
                                strongly suggests this spot for a meal on the cape.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-5.webp" alt="p5" />
                                <h5 class="fw-semibold dark-text mt-2">Makenna Clark</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper testimonial dir-rtl">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                I was so impressed with my breakfast this morning! I tried
                                the Fried Green Tomato Benedict and my boyfriend got the
                                Crab Cakes Benedict
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-1.webp" alt="p1" />
                                <h5 class="fw-semibold dark-text mt-2">Gunjan Puri</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                We both finished our whole plates and were so impressed with
                                the quality of the food and the short amount of time it took
                                to receive it.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-2.webp" alt="p2" />
                                <h5 class="fw-semibold dark-text mt-2">Maggie Martin</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                This is always our breakfast stop before heading home from
                                vacation. Always delicious. Always great service. Always
                                worth the stop.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-3.webp" alt="p3" />
                                <h5 class="fw-semibold dark-text mt-2">Amina James</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                The absolute best red sauce. Weather on Pizza or Pasta, it’s
                                honestly delicious. Portions are huge and the staff is
                                extremely friendly and courteous.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-4.webp" alt="p4" />
                                <h5 class="fw-semibold dark-text mt-2">Hailey Jackson</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="testimonial-box">
                        <img class="img-fluid comma-icon" src="assets/images/commas.webp" alt="commas" />
                        <div class="testimonial-content">
                            <p>
                                It was a fantastic breakfast. Like a delicious homestyle
                                rural savoury breakfast. I enjoyed the entire experience and
                                strongly suggests this spot for a meal on the cape.
                            </p>
                            <div class="testi-bottom">
                                <img class="img-fluid img" src="assets/images/people/review-person-5.webp" alt="p5" />
                                <h5 class="fw-semibold dark-text mt-2">Logan Ross</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- testimonial section end -->

<!-- team section starts -->
<section class="section-b-space" id="team">
    <div class="container">
        <div class="title animated-title">
            <div class="loader-line"></div>
            <h2>Our Team</h2>
            <div class="sub-title">
                <p>
                    Our team is committed to delivering innovative solutions that meet
                    the needs of our clients and users.
                </p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                <div class="team-box">
                    <div class="member-image">
                        <img class="img-fluid img" src="assets/images/people/team-person-1.webp" alt="person1" />
                    </div>
                    <div class="member-details">
                        <h5 class="member-name fw-semibold dark-text">
                            Harriet Watson
                        </h5>
                        <h6 class="fw-normal content-color">Co - Founder</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                <div class="team-box">
                    <div class="member-image">
                        <img class="img-fluid img" src="assets/images/people/team-person-2.webp" alt="person2" />
                    </div>
                    <div class="member-details">
                        <h5 class="member-name fw-semibold dark-text">
                            Jenifer Peters
                        </h5>
                        <h6 class="fw-normal content-color">Founder</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                <div class="team-box">
                    <div class="member-image">
                        <img class="img-fluid img" src="assets/images/people/team-person-3.webp" alt="person3" />
                    </div>
                    <div class="member-details">
                        <h5 class="member-name fw-semibold dark-text">Rock Smith</h5>
                        <h6 class="fw-normal content-color">Manager</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- team section end -->

<!-- contact section starts -->
<section class="section-b-space" id="contact">
    <div class="container">
        <div class="title animated-title">
            <div class="loader-line"></div>
            <div class="d-flex align-items-center justify-content-between flex-wrap w-100">
                <div>
                    <h2>Inform us of Yourself</h2>
                    <h6>
                        Contact us if you have any queries or merely want to say hi.
                    </h6>
                </div>
            </div>
        </div>
        <div class="contact-detail">
            <div class="row g-4">
                <div class="col-xxl-3 col-md-6">
                    <div class="contact-detail-box">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div>
                            <div class="contact-detail-title">
                                <h4>Phone</h4>
                            </div>
                            <div class="contact-detail-contain">
                                <p>(+1) 618 190 496</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="contact-detail-box">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div>
                            <div class="contact-detail-title">
                                <h4>Shop Location</h4>
                            </div>
                            <div class="contact-detail-contain">
                                <p>Cruce Casa de Postas 29</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-xl-8">
                <div class="contact-form">
                    <form class="row g-3"
                        onsubmit="getFormInfo(event, 'contactform','.contact-form-btn-spinner','.contact-form-btn-text', '.contact-form-response-text');">
                        <div class="col-md-6">
                            <label for="inputFirstname" class="form-label mt-0">First Name</label>
                            <input type="text" class="form-control" id="inputFirstname"
                                placeholder="Enter your fist name" name="fname" required />
                        </div>
                        <div class="col-md-6">
                            <label for="inputLastname" class="form-label mt-0">Last Name</label>
                            <input type="text" class="form-control" id="inputLastname"
                                placeholder="Enter your last name" name="lname" />
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"
                                name="email" />
                        </div>
                        <div class="col-md-6">
                            <label for="inputPhone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="inputPhone" placeholder="Enter your number"
                                name="phone" required />
                        </div>
                        <div class="col-md-12">
                            <label for="inputtext" class="form-label">How Can We Help You?</label>
                            <textarea class="form-control" id="inputtext" rows="3"
                                placeholder="Hi there, I would like to...." name="message" required></textarea>
                        </div>
                        <button type="submit" class="contact-btn">
                            <span class="btn theme-btn mt-0 contact-form-btn-text">SUBMIT </span>
                        </button>
                        <span class="contact-form-btn-spinner d-none"></span>
                        <p class="contact-form-response-text fw-bold"></p>
                    </form>
                </div>
            </div>
            <div class="col-xl-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3332.2625191604434!2d-81.27475172358754!3d33.364211773423776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f91bc85b065379%3A0x2d14689bf5c52e3d!2s93%20Songbird%20Cir%2C%20Blackville%2C%20SC%2029817%2C%20USA!5e0!3m2!1sen!2sin!4v1690353019073!5m2!1sen!2sin"
                    width="600" height="450" class="contact-map border-0 w-100 h-100" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- contact section end -->
<?php include 'footer.php'; ?>