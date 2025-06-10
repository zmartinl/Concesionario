document.addEventListener("DOMContentLoaded", function () {

        const swiper = new Swiper(".mySwiper", {

            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            keyboard: {
                enabled: true,
                onlyInViewport: false,
            },

        });
        
    });