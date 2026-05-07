import Swiper from 'swiper';
import { Navigation } from 'swiper';
import 'swiper/css';

export default class NewsSlider {
    constructor() {
        const el = document.querySelector('.js-news-slider');
        if (!el) return;

        new Swiper(el, {
            modules: [Navigation],
            slidesPerView: 1,
            spaceBetween: 24,
            navigation: {
                nextEl: '.js-news-next',
                prevEl: '.js-news-prev',
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }
}

new NewsSlider();
