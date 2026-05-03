/**
 * FJDF — Navbar & Modal JS
 * Hamburger Toggle, Mobile Menu, Cert Modal
 */

// ---------------------------------------------------------------------------
// Navbar: Hamburger Toggle
// ---------------------------------------------------------------------------
const header  = document.getElementById( 'site-header' );
const toggle  = document.getElementById( 'nav-toggle' );
const nav     = document.getElementById( 'site-nav' );

if ( header && toggle && nav ) {
	toggle.addEventListener( 'click', () => {
		const isOpen = header.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', String( isOpen ) );
		toggle.setAttribute( 'aria-label', isOpen
			? fjdfData?.i18n?.closeMenu  || 'Menü schließen'
			: fjdfData?.i18n?.openMenu   || 'Menü öffnen'
		);
		document.body.style.overflow = isOpen ? 'hidden' : '';
	} );

	// Schließen bei Escape
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' && header.classList.contains( 'is-open' ) ) {
			header.classList.remove( 'is-open' );
			toggle.setAttribute( 'aria-expanded', 'false' );
			document.body.style.overflow = '';
			toggle.focus();
		}
	} );

	// Schließen bei Klick auf Nav-Link (Mobile)
	nav.querySelectorAll( 'a' ).forEach( link => {
		link.addEventListener( 'click', () => {
			if ( header.classList.contains( 'is-open' ) ) {
				header.classList.remove( 'is-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
				document.body.style.overflow = '';
			}
		} );
	} );
}

// ---------------------------------------------------------------------------
// Cert Modal
// ---------------------------------------------------------------------------
const modal = document.getElementById( 'cert-modal' );

function openCertModal() {
	if ( ! modal ) return;
	modal.setAttribute( 'aria-hidden', 'false' );
	document.body.style.overflow = 'hidden';

	// Focus auf ersten Input
	const firstInput = modal.querySelector( 'input' );
	setTimeout( () => firstInput?.focus(), 50 );
}

function closeCertModal() {
	if ( ! modal ) return;
	modal.setAttribute( 'aria-hidden', 'true' );
	document.body.style.overflow = '';
}

if ( modal ) {
	// Öffnen via [data-open-cert-modal]
	document.querySelectorAll( '[data-open-cert-modal]' ).forEach( btn => {
		btn.addEventListener( 'click', ( e ) => {
			e.preventDefault();
			openCertModal();
		} );
	} );

	// Schließen via [data-close-modal]
	modal.querySelectorAll( '[data-close-modal]' ).forEach( el => {
		el.addEventListener( 'click', closeCertModal );
	} );

	// Schließen via Escape
	document.addEventListener( 'keydown', ( e ) => {
		if ( e.key === 'Escape' && modal.getAttribute( 'aria-hidden' ) === 'false' ) {
			closeCertModal();
		}
	} );

	// Fokus-Trap
	modal.addEventListener( 'keydown', ( e ) => {
		if ( e.key !== 'Tab' ) return;
		const focusable = modal.querySelectorAll(
			'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
		);
		const first = focusable[0];
		const last  = focusable[ focusable.length - 1 ];

		if ( e.shiftKey && document.activeElement === first ) {
			e.preventDefault();
			last.focus();
		} else if ( ! e.shiftKey && document.activeElement === last ) {
			e.preventDefault();
			first.focus();
		}
	} );

	// Formular Submit
	const certForm = document.getElementById( 'cert-modal-form' );
	if ( certForm ) {
		certForm.addEventListener( 'submit', async ( e ) => {
			e.preventDefault();
			const feedback = certForm.querySelector( '.cert-modal__feedback' );
			const btn      = certForm.querySelector( '[type="submit"]' );

			btn.disabled = true;
			if ( feedback ) {
				feedback.textContent = '';
				feedback.className   = 'cert-modal__feedback';
			}

			try {
				const data = new FormData( certForm );
				data.append( 'action', 'fjdf_cert_request' );

				const res  = await fetch( fjdfData.ajaxUrl, { method: 'POST', body: data } );
				const json = await res.json();

				if ( json.success ) {
					if ( feedback ) {
						feedback.textContent = json.data?.message || '¡Solicitud enviada con éxito!';
						feedback.classList.add( 'is-success' );
					}
					certForm.reset();
					setTimeout( closeCertModal, 2500 );
				} else {
					throw new Error( json.data?.message || 'Error al enviar.' );
				}
			} catch ( err ) {
				if ( feedback ) {
					feedback.textContent = err.message;
					feedback.classList.add( 'is-error' );
				}
			} finally {
				btn.disabled = false;
			}
		} );
	}
}

// Exportieren für andere Module
export { openCertModal, closeCertModal };
