/**
 * FJDF — impact-tabs.js
 * Impact Stats Tabs (Individual / Educacional / Familiar)
 * Auf Homepage und Qué Hacemos Seite
 */

document.querySelectorAll( '.impact-tabs' ).forEach( tablist => {
	const tabs   = tablist.querySelectorAll( '.impact-tabs__btn' );
	const panels = tablist.closest( 'section' )?.querySelectorAll( '.impact-tabpanel' );

	if ( ! tabs.length ) return;

	tabs.forEach( ( tab, i ) => {
		tab.addEventListener( 'click', () => {
			// Tabs
			tabs.forEach( t => {
				t.classList.remove( 'is-active' );
				t.setAttribute( 'aria-selected', 'false' );
			} );
			tab.classList.add( 'is-active' );
			tab.setAttribute( 'aria-selected', 'true' );

			// Panels (falls vorhanden — Qué Hacemos Seite)
			if ( panels?.length ) {
				panels.forEach( ( panel, pi ) => {
					const isActive = pi === i;
					panel.classList.toggle( 'is-active', isActive );
					panel.toggleAttribute( 'hidden', ! isActive );
				} );
			}
		} );

		// Keyboard: Pfeiltasten
		tab.addEventListener( 'keydown', ( e ) => {
			let idx = i;
			if ( e.key === 'ArrowRight' ) idx = ( i + 1 ) % tabs.length;
			if ( e.key === 'ArrowLeft'  ) idx = ( i - 1 + tabs.length ) % tabs.length;
			if ( idx !== i ) {
				e.preventDefault();
				tabs[ idx ].click();
				tabs[ idx ].focus();
			}
		} );
	} );
} );
