import Swiper from 'swiper';
import { Navigation, Pagination, A11y } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css';

// ---------------------------------------------------------------------------
// Stats Slider — Custom Interval Autoplay, endlos
// ---------------------------------------------------------------------------
const statsSliderEl = document.querySelector( '.js-stats-slider' );
if ( statsSliderEl ) {
	const AUTOPLAY_DELAY = 5000;
	let autoTimer = null;

	const stopAuto  = ()          => { clearInterval( autoTimer ); autoTimer = null; };
	const startAuto = ( swiper )  => {
		stopAuto();
		autoTimer = setInterval( () => {
			if ( swiper.isEnd ) {
				swiper.slideTo( 0, 0 );   // sofortiger Sprung — gleicher Inhalt, unsichtbar
			} else {
				swiper.slideNext();
			}
		}, AUTOPLAY_DELAY );
	};

	new Swiper( statsSliderEl, {
		modules:       [ Pagination ],
		loop:          false,
		speed:         900,
		cssEase:       'ease-in-out',
		slidesPerView: 1,
		spaceBetween:  24,
		grabCursor:    true,
		pagination: {
			el:        '.js-stats-pagination',
			clickable: true,
		},
		breakpoints: {
			640:  { slidesPerView: 2, spaceBetween: 24 },
			1024: { slidesPerView: 3, spaceBetween: 32 },
		},
		on: {
			init( swiper ) {
				requestAnimationFrame( () => {
					swiper.update();
					startAuto( swiper );
				} );
			},
			touchStart() { stopAuto(); },
			touchEnd( swiper )   { startAuto( swiper ); },
		},
	} );
}

// ---------------------------------------------------------------------------
// Testimonials Slider
// ---------------------------------------------------------------------------
const testimonialSliders = document.querySelectorAll( '.testimonials__slider' );
testimonialSliders.forEach( el => {
	new Swiper( el, {
		modules:       [ Navigation, Pagination, A11y ],
		slidesPerView: 1,
		spaceBetween:  0,
		loop:          testimonialSliders.length > 1,
		grabCursor:    true,
		a11y: {
			prevSlideMessage: 'Vorheriges Testimonial',
			nextSlideMessage: 'Nächstes Testimonial',
		},
		pagination: {
			el:        '.testimonials__pagination',
			clickable: true,
		},
		navigation: {
			prevEl: '.testimonials__btn--prev',
			nextEl: '.testimonials__btn--next',
		},
	} );
} );

// ---------------------------------------------------------------------------
// Otras Noticias Carousel (Mobile, Single Post)
// ---------------------------------------------------------------------------
const otrasCarousels = document.querySelectorAll( '.otras-noticias-carousel' );
otrasCarousels.forEach( el => {
	new Swiper( el, {
		modules:       [ Navigation, Pagination, A11y ],
		slidesPerView: 1.2,
		spaceBetween:  16,
		grabCursor:    true,
		a11y: {
			prevSlideMessage: 'Vorherige Neuigkeit',
			nextSlideMessage: 'Nächste Neuigkeit',
		},
		pagination: {
			el:        el.querySelector( '.otras-noticias-carousel__pagination' ),
			clickable: true,
		},
		navigation: {
			prevEl: el.querySelector( '.swiper-button-prev' ),
			nextEl: el.querySelector( '.swiper-button-next' ),
		},
		breakpoints: {
			576: { slidesPerView: 2, spaceBetween: 20 },
		},
	} );
} );
