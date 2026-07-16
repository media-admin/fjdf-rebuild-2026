import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper';
import 'swiper/css';

export default class TestimonialSlider {
    constructor() {
        const el = document.querySelector('.js-testimonial-slider');
        if (!el) return;

        new Swiper(el, {
            modules: [Navigation, Pagination, Autoplay],
            slidesPerView: 1,
            loop: true,
            autoplay: { delay: 6000, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                prevEl: el.querySelector('.js-test-prev'),
                nextEl: el.querySelector('.js-test-next'),
            },
        });
    }
}

new TestimonialSlider();