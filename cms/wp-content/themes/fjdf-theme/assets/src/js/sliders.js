/**
 * FJDF — sliders.js
 * Swiper Instanzen:
 *  - Testimonials Slider (Homepage, Qué Hacemos)
 *  - Otras Noticias Carousel (Single Post, Mobile)
 */

import Swiper from 'swiper';
import { Navigation, Pagination, A11y } from 'swiper/modules';

// ---------------------------------------------------------------------------
// Testimonials Slider
// ---------------------------------------------------------------------------
const testimonialSliders = document.querySelectorAll( '.testimonials__slider' );

testimonialSliders.forEach( el => {
	new Swiper( el, {
		modules:    [ Navigation, Pagination, A11y ],
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
