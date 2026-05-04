import Swiper from 'swiper';
import { Navigation, Thumbs, Autoplay } from 'swiper/modules';
import 'swiper/css';

export default class Gallery {
    constructor() {
        const thumbsEl = document.querySelector('.js-gallery-thumbs');
        const mainEl   = document.querySelector('.js-gallery-main');
        if (!mainEl || !thumbsEl) return;

        const thumbsSwiper = new Swiper(thumbsEl, {
            modules: [Navigation],
            slidesPerView: thumbsEl.querySelectorAll('.swiper-slide').length,
            spaceBetween: 12,
            watchSlidesProgress: true,
        });

        new Swiper(mainEl, {
            modules: [Navigation, Thumbs, Autoplay],
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
            navigation: {
                nextEl: '.js-gallery-next',
                prevEl: '.js-gallery-prev',
            },
            thumbs: { swiper: thumbsSwiper },
        });
    }
}

new Gallery();
