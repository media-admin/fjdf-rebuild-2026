import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

export default class StatsSlider {
    constructor() {
        const el = document.querySelector('.js-stats-slider');
        if (!el) return;

        new Swiper(el, {
            modules: [Pagination, Autoplay],
            rewind: true,
            speed: 600,
            slidesPerView: 1,
            spaceBetween: 24,
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.js-stats-pagination',
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 24 },
                1024: { slidesPerView: 3, spaceBetween: 32 },
            },
        });
    }
}
