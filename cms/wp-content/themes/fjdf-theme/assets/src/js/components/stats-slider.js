import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';

export default class StatsSlider {
    constructor() {
        const el = document.querySelector('.js-stats-slider');
        if (!el) return;

        // Slides 3x duplizieren damit Loop-Klone entstehen können
        const wrapper = el.querySelector('.swiper-wrapper');
        const originalSlides = [...wrapper.children];
        originalSlides.forEach(slide => {
            wrapper.appendChild(slide.cloneNode(true));
            wrapper.appendChild(slide.cloneNode(true));
        });

        new Swiper(el, {
            modules: [Pagination, Autoplay],
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: document.querySelector('.js-stats-pagination'),
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
            },
        });
    }
}