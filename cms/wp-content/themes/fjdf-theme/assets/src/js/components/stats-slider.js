import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';

export default class StatsSlider {
        constructor() {
                const el = document.querySelector('.js-stats-slider');
                if (!el) return;
                new Swiper(el, {
                        modules: [Pagination, Autoplay],
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: false,
                        autoplay: { delay: 3000, disableOnInteraction: false, pauseOnMouseEnter: true },
                        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
                        observer: true,
                        observeParents: true,
                });
        }
}
