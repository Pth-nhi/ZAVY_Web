<section class="home-page">

    <!-- =========================
         BANNER SLIDER
         ========================= -->

    <div class="banner-slider">

        <div class="banner-slide active">
            <img
                src="public/images/banner1.jpg"
                alt="ZAVY Fashion - New Arrival"
            >
        </div>

        <div class="banner-slide">
            <img
                src="public/images/banner2.jpg"
                alt="We Are ZAVY - Wear Your Way"
            >
        </div>

        <div class="banner-slide">
            <img
                src="public/images/banner3.jpg"
                alt="ZAVY Fashion Collection"
            >
        </div>

        <!-- Nút chuyển banner -->
        <button class="banner-prev" type="button">
            &#10094;
        </button>

        <button class="banner-next" type="button">
            &#10095;
        </button>

        <!-- Chấm chỉ vị trí -->
        <div class="banner-dots">
            <button class="banner-dot active" type="button"></button>
            <button class="banner-dot" type="button"></button>
            <button class="banner-dot" type="button"></button>
        </div>

    </div>


    <!-- =========================
         GIỚI THIỆU
         ========================= -->

    <div class="home-intro">

        <p class="section-subtitle">
            KHÁM PHÁ ZAVY
        </p>

        <h2>Phong cách dành cho bạn</h2>

        <p>
            ZAVYWEB mang đến những sản phẩm thời trang phù hợp
            với nhiều phong cách và nhu cầu sử dụng khác nhau.
        </p>

    </div>


    <!-- =========================
         ĐIỂM NỔI BẬT
         ========================= -->

    <div class="home-features">

        <div class="feature-item">
            <div class="feature-icon">01</div>

            <h3>Phong cách</h3>

            <p>
                Thiết kế trẻ trung, hiện đại và dễ phối đồ.
            </p>
        </div>


        <div class="feature-item">
            <div class="feature-icon">02</div>

            <h3>Đa dạng lựa chọn</h3>

            <p>
                Nhiều sản phẩm, kích thước và màu sắc để lựa chọn.
            </p>
        </div>


        <div class="feature-item">
            <div class="feature-icon">03</div>

            <h3>Mua sắm dễ dàng</h3>

            <p>
                Tìm kiếm, chọn sản phẩm và đặt hàng trực tuyến thuận tiện.
            </p>
        </div>

    </div>

</section>


<!-- =========================
     BANNER SLIDER JAVASCRIPT
     ========================= -->

<script>

const slides = document.querySelectorAll('.banner-slide');
const dots = document.querySelectorAll('.banner-dot');

const prevButton = document.querySelector('.banner-prev');
const nextButton = document.querySelector('.banner-next');

let currentSlide = 0;
let slideTimer;


/* Hiển thị banner */

function showSlide(index) {

    if (index >= slides.length) {
        currentSlide = 0;
    }

    if (index < 0) {
        currentSlide = slides.length - 1;
    }

    slides.forEach(function(slide) {
        slide.classList.remove('active');
    });

    dots.forEach(function(dot) {
        dot.classList.remove('active');
    });

    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
}


/* Banner tiếp theo */

function nextSlide() {

    currentSlide++;

    if (currentSlide >= slides.length) {
        currentSlide = 0;
    }

    showSlide(currentSlide);
}


/* Banner trước */

function previousSlide() {

    currentSlide--;

    if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    }

    showSlide(currentSlide);
}


/* Tự động chuyển banner */

function startSlider() {

    slideTimer = setInterval(function() {
        nextSlide();
    }, 5000);

}


/* Khi bấm nút */

nextButton.addEventListener('click', function() {

    nextSlide();

    clearInterval(slideTimer);
    startSlider();

});


prevButton.addEventListener('click', function() {

    previousSlide();

    clearInterval(slideTimer);
    startSlider();

});


/* Khi bấm chấm */

dots.forEach(function(dot, index) {

    dot.addEventListener('click', function() {

        currentSlide = index;

        showSlide(currentSlide);

        clearInterval(slideTimer);
        startSlider();

    });

});


/* Chạy slider */

showSlide(currentSlide);
startSlider();

</script>