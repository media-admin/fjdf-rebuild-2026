/**
 * FJDF Theme — main.js
 * Vite Entry Point
 *
 * Strategie: Dynamic Imports — JS wird nur geladen
 * wenn das zugehörige DOM-Element vorhanden ist.
 * Konsistent mit dem Starter Kit (27+ Dynamic Import Komponenten).
 */

// CSS — muss in main.js importiert werden damit Vite es verarbeitet
import '../scss/style.scss';

// Immer laden (global)
import './navbar.js';

// Dynamic Imports — nur wenn DOM-Element vorhanden
if ( document.querySelector( '.dona-layout' ) ) {
	import( './donation-form.js' );
}

if ( document.querySelector( '.js-gallery-thumbs' ) ) {
	import( './components/gallery.js' );
}

if ( document.querySelector( '#load-more-news' ) ) {
	import( './load-more.js' );
}

if ( document.querySelector( '.js-testimonial-slider' ) ) {
	import( './components/testimonial-slider.js' );
}
if ( document.querySelector( '.impact-tabs' ) ) {
	import( './impact-tabs.js' );
}

if ( document.querySelector( '.testimonials__slider' ) || document.querySelector( '.otras-noticias-carousel' ) ) {
	import( './sliders.js' );
}

// Video Play Button
document.addEventListener('DOMContentLoaded', () => {
	const trigger = document.getElementById('video-trigger');
	const iframe  = document.getElementById('video-iframe');
	if (!trigger || !iframe) return;

	const activate = () => {
		const el = iframe.querySelector('iframe');
		if (el) el.src = el.dataset.src;
		trigger.hidden = true;
		iframe.hidden  = false;
	};

	trigger.addEventListener('click', activate);
	trigger.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') activate(); });
});

// Modal
import('./components/modal.js').then(m => new m.default());
import("./components/stats-slider.js").then(m => new m.default());
import("./components/back-to-top.js").then(m => new m.default());
import("./components/cookie-notice.js").then(m => new m.default());// Video Modal: autoplay beim Öffnen, stop beim Schließen
document.addEventListener('DOMContentLoaded', () => {
    const videoModal = document.getElementById('video-modal-testimonial');
    if (!videoModal) return;
    const iframe = videoModal.querySelector('iframe[data-src]');
    if (!iframe) return;

    const observer = new MutationObserver(() => {
        if (videoModal.classList.contains('is-open')) {
            if (!iframe.src || iframe.src === window.location.href) {
                iframe.src = iframe.dataset.src;
            }
        } else {
            iframe.src = '';
        }
    });
    observer.observe(videoModal, { attributes: true, attributeFilter: ['class'] });
});
