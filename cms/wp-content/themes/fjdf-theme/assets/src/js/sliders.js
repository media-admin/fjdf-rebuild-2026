import Swiper, { Navigation, Pagination, Autoplay, A11y } from 'swiper';
import 'swiper/css';

// ---------------------------------------------------------------------------
// Stats Slider — Swiper v8, loop: true, 3 Slides, 3 Dots
// ---------------------------------------------------------------------------
const statsSliderEl = document.querySelector( '.js-stats-slider' );
if ( statsSliderEl ) {
	new Swiper( statsSliderEl, {
		modules:       [ Pagination, Autoplay ],
		loop:          true,
		speed:         500,
		slidesPerView: 1,
		spaceBetween:  24,
		grabCursor:    true,
		autoplay: {
			delay:                5000,
			disableOnInteraction: false,
		},
		pagination: {
			el:        '.js-stats-pagination',
			clickable: true,
		},
		breakpoints: {
			640:  { slidesPerView: 2, spaceBetween: 24 },
			1024: { slidesPerView: 3, spaceBetween: 32 },
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
