import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';

export default class StatsSlider {
        constructor() {
                const el = document.querySelector('.js-stats-slider');
                if (!el) return;

                const swiper = new Swiper(el, {
                        modules: [Pagination, Autoplay],
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: false,
                        autoplay: {
                                delay: 3000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true,
                        },
                        pagination: {
                                el: el.querySelector('.swiper-pagination'),
                                clickable: true,
                        },
                        on: {
                                afterInit(s) {
                                        // Transform-Bug: manuell auf Slide 0 zurücksetzen
                                        s.wrapperEl.style.transform = 'translate3d(0px, 0px, 0px)';
                                        s.activeIndex = 0;
                                        s.realIndex = 0;
                                        s.updateProgress();
                                        s.updateSlidesClasses();
                                }
                        }
                });
        }
}
