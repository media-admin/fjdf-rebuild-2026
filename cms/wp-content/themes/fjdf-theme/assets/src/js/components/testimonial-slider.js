import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';

export default class TestimonialSlider {
    constructor() {
        const el = document.querySelector('.js-testimonial-slider');
        if (!el) return;

        new Swiper(el, {
            modules: [Pagination, Autoplay],
            slidesPerView: 1,
            loop: true,
            autoplay: { delay: 6000, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });
    }
}

new TestimonialSlider();
