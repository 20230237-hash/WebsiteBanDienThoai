/* ===== HERO BANNER SLIDER ===== */

document.addEventListener("DOMContentLoaded", function () {

    const slides = document.querySelectorAll(".hero-slider .slide");

    if (slides.length === 0) return;

    let index = 0;

    function showSlide() {

        // Ẩn tất cả slide
        slides.forEach(function(slide){
            slide.classList.remove("active");
        });

        // Hiện slide hiện tại
        slides[index].classList.add("active");

        // Tăng index
        index++;

        // Nếu vượt quá thì quay lại slide đầu
        if(index >= slides.length){
            index = 0;
        }
    }

    // chạy lần đầu
    showSlide();

    // tự động chạy
    setInterval(showSlide, 3000);

});
