let swiperCards = new Swiper('.card__content', {
    // Optional parameters
    /*direction: 'vertical',*/
    loop: true,
    spaceBetween: 32,
    grabCursor: true,


    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true,
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints:{
        600:{
            slidesPerView:2,
        },
        968:{
            slidesPerView: 3,
        },
    },

    /*// And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },*/
});