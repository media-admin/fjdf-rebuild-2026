/**
 * FJDF — load-more.js
 * "Ver más" Button im Noticias-Archiv
 * AJAX: fjdf_load_more_news Handler in news-helpers.php
 */

const btn     = document.getElementById( 'load-more-news' );
const grid    = document.getElementById( 'news-grid' );

if ( btn && grid ) {

	let page    = parseInt( btn.dataset.page, 10 ) || 2;
	const max   = parseInt( btn.dataset.max,  10 ) || 1;
	const excl  = btn.dataset.exclude || 0;

	btn.addEventListener( 'click', async () => {
		if ( btn.disabled ) return;

		// Loading State
		btn.disabled = true;
		btn.classList.add( 'is-loading' );
		const originalHTML = btn.innerHTML;
		btn.innerHTML = `<span>${ fjdfData?.i18n?.loading || 'Cargando...' }</span>`;

		try {
			const body = new FormData();
			body.append( 'action',  'fjdf_load_more_news' );
			body.append( 'nonce',   fjdfData.nonce );
			body.append( 'page',    page );
			body.append( 'exclude', excl );

			const res  = await fetch( fjdfData.ajaxUrl, { method: 'POST', body } );
			const json = await res.json();

			if ( ! json.success ) throw new Error( json.data?.message || 'Error' );

			// HTML einfügen
			const tmp = document.createElement( 'div' );
			tmp.innerHTML = json.data.html;

			// Neue Cards mit Fade-In
			Array.from( tmp.children ).forEach( card => {
				card.style.opacity = '0';
				card.style.transform = 'translateY(12px)';
				grid.appendChild( card );

				requestAnimationFrame( () => {
					card.style.transition = 'opacity 300ms ease, transform 300ms ease';
					card.style.opacity    = '1';
					card.style.transform  = 'translateY(0)';
				} );
			} );

			page++;

			// Button ausblenden wenn keine weiteren Seiten
			if ( ! json.data.has_more || page > max ) {
				btn.style.display = 'none';
			} else {
				btn.innerHTML = originalHTML;
				btn.disabled  = false;
				btn.classList.remove( 'is-loading' );
			}

		} catch ( err ) {
			console.error( 'Load more error:', err );
			btn.innerHTML = originalHTML;
			btn.disabled  = false;
			btn.classList.remove( 'is-loading' );
		}
	} );
}
