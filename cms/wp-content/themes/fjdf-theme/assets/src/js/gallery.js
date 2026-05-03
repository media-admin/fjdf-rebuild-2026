/**
 * FJDF — gallery.js
 * Nosotros Galerie: Thumbnail-Klick → Hauptbild wechseln
 */

const mainImg  = document.getElementById( 'gallery-main-img' );
const thumbBtns = document.querySelectorAll( '.nosotros-gallery__thumb' );
const mainWrap  = mainImg?.closest( '.nosotros-gallery__main' );

if ( mainImg && thumbBtns.length ) {

	thumbBtns.forEach( btn => {
		btn.addEventListener( 'click', () => {
			const fullSrc = btn.dataset.full;
			const alt     = btn.dataset.alt || '';

			if ( ! fullSrc || fullSrc === mainImg.src ) return;

			// Fade-Out
			if ( mainWrap ) mainWrap.style.opacity = '0.5';

			// Bild wechseln
			mainImg.src = fullSrc;
			mainImg.alt = alt;

			mainImg.onload = () => {
				if ( mainWrap ) mainWrap.style.opacity = '1';
			};

			// Aktiver Thumb
			thumbBtns.forEach( b => b.classList.remove( 'is-active' ) );
			btn.classList.add( 'is-active' );
		} );

		// Keyboard: Enter / Space
		btn.addEventListener( 'keydown', ( e ) => {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				btn.click();
			}
		} );
	} );
}
