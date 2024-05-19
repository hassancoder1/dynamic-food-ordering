// Scroll Navbarr Sticky & back to top
$(document).ready(function () {
  $("#back-to-top-btn").hide();

  $(window).on("scroll", function () {
    const scrollTop = $(window).scrollTop();
    const docHeight = $(document).height();
    const winHeight = $(window).height();
    const scrollPercent = (scrollTop / (docHeight - winHeight)) * 100;

    if (scrollTop > 20) {
      $(".header-light").addClass("position-fixed sticky");
    } else {
      $(".header-light").removeClass("position-fixed sticky");
    }

    if (scrollPercent > 60) {
      $("#back-to-top-btn").fadeIn();
    } else {
      $("#back-to-top-btn").fadeOut();
    }
  });
  //  For Footer Year
  $("#current-year").text(new Date().getFullYear());
  // Product Cart functionality
  const dbName = "ShoppingCartDB";
  let db;

  // Open (or create) the database
  const request = indexedDB.open(dbName, 1);

  request.onerror = function (event) {
    console.error("Database error:", event.target.errorCode);
  };

  request.onsuccess = function (event) {
    db = event.target.result;
    loadCartState();
  };

  request.onupgradeneeded = function (event) {
    db = event.target.result;
    const objectStore = db.createObjectStore("cart", { keyPath: "id" });
  };

  $(".cart-btn").click(function () {
    const productBox = $(this).closest(".pharmacy-product-box");
    const productId = productBox.data("id");
    const productName = productBox.find(".product-name").text().trim();
    const productPrice = parseFloat(productBox.find(".price").text());
    const currency = productBox.find(".currency").text();
    const productImg = productBox.find("img").attr("src");
    const quantity = parseInt(productBox.find('input[type="number"]').val());

    const product = {
      id: productId,
      name: productName,
      price: productPrice,
      currency: currency,
      img: productImg,
      quantity: quantity,
    };

    const transaction = db.transaction(["cart"], "readwrite");
    const objectStore = transaction.objectStore("cart");

    if ($(this).hasClass("added")) {
      // Remove item from cart
      objectStore.delete(productId);
      $(this).text("Add Cart").removeClass("added");
    } else {
      // Add item to cart
      objectStore.put(product);
      $(this).text("Added").addClass("added");
    }

    transaction.oncomplete = function () {
      updateCartCount();
    };
  });

  $(".plus-minus .add").click(function () {
    const input = $(this).siblings("input");
    let value = parseInt(input.val());
    if (value < 25) {
      input.val(value + 1).change();
    }
  });

  $(".plus-minus .sub").click(function () {
    const input = $(this).siblings("input");
    let value = parseInt(input.val());
    if (value > 1) {
      input.val(value - 1).change();
    }
  });

  $('input[type="number"]').change(function () {
    const productBox = $(this).closest(".pharmacy-product-box");
    const productId = productBox.data("id");
    const quantity = parseInt($(this).val());

    const transaction = db.transaction(["cart"], "readwrite");
    const objectStore = transaction.objectStore("cart");
    const request = objectStore.get(productId);

    request.onsuccess = function (event) {
      const data = event.target.result;
      if (data) {
        data.quantity = quantity;
        objectStore.put(data);
        updateCartCount();
      }
    };
  });

  // Function to update the cart count in the icon
  function updateCartCount() {
    const transaction = db.transaction(["cart"], "readonly");
    const objectStore = transaction.objectStore("cart");
    const request = objectStore.getAll();

    request.onsuccess = function (event) {
      const cartItems = event.target.result;
      let count = 0;
      cartItems.forEach((item) => {
        count += item.quantity;
      });
      $("#cart-count").text(count);
    };
  }

  // Function to load cart state from IndexedDB
  function loadCartState() {
    const transaction = db.transaction(["cart"], "readonly");
    const objectStore = transaction.objectStore("cart");
    const request = objectStore.getAll();

    request.onsuccess = function (event) {
      const cartItems = event.target.result;
      $(".pharmacy-product-box").each(function () {
        const productBox = $(this);
        const productId = productBox.data("id");
        const cartItem = cartItems.find((item) => item.id === productId);
        if (cartItem) {
          productBox.find('input[type="number"]').val(cartItem.quantity);
          productBox.find(".cart-btn").text("Added").addClass("added");
        }
      });
      updateCartCount();
    };
  }
});
