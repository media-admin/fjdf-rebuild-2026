/**
 * FJDF — donation-form.js
 * Donation Page Interaktivität:
 *  - Frequency Toggle (Única / Mensual)
 *  - Betrag-Auswahl + Custom Input
 *  - Submit-Button Label dynamisch aktualisieren
 *  - Zahlungsmethoden-Auswahl
 *  - Cert-Modal Trigger
 */

class DonationForm {

	constructor() {
		this.form          = document.querySelector( '.dona-layout__form-inner' );
		this.freqBtns      = document.querySelectorAll( '.dona-frequency__btn' );
		this.amountPanels  = document.querySelectorAll( '.dona-amounts' );
		this.submitBtn     = document.getElementById( 'dona-submit' );
		this.submitAmount  = document.getElementById( 'dona-submit-amount' );
		this.customInputs  = document.querySelectorAll( '.dona-custom-input' );

		if ( ! this.form ) return;

		this.currentFreq   = 'once';
		this.currentAmount = this.getDefaultAmount( 'once' );

		this.init();
	}

	init() {
		this.bindFrequencyTabs();
		this.bindAmountOptions();
		this.bindCustomInputs();
		this.bindPaymentMethods();
		this.updateSubmitLabel();
	}

	// ---------------------------------------------------------------------------
	// Frequency Tabs (Única / Mensual)
	// ---------------------------------------------------------------------------
	bindFrequencyTabs() {
		this.freqBtns.forEach( btn => {
			btn.addEventListener( 'click', () => {
				const freq = btn.dataset.frequency;
				if ( freq === this.currentFreq ) return;

				this.currentFreq = freq;

				// Tab States
				this.freqBtns.forEach( b => {
					b.classList.remove( 'is-active' );
					b.setAttribute( 'aria-selected', 'false' );
				} );
				btn.classList.add( 'is-active' );
				btn.setAttribute( 'aria-selected', 'true' );

				// Panels
				this.amountPanels.forEach( panel => {
					const isTarget = panel.id === `amounts-${freq}`;
					panel.classList.toggle( 'is-active', isTarget );
					panel.toggleAttribute( 'hidden', ! isTarget );
				} );

				// Betrag des neuen Tabs übernehmen
				this.currentAmount = this.getDefaultAmount( freq );
				this.updateSubmitLabel();
			} );
		} );
	}

	// ---------------------------------------------------------------------------
	// Betrag-Optionen
	// ---------------------------------------------------------------------------
	bindAmountOptions() {
		document.querySelectorAll( '.dona-amount-option input[type="radio"]' ).forEach( radio => {
			radio.addEventListener( 'change', () => {
				if ( radio.value !== 'custom' ) {
					this.currentAmount = parseFloat( radio.value );
					this.updateSubmitLabel();
				}
			} );
		} );
	}

	// ---------------------------------------------------------------------------
	// Custom Betrag Input
	// ---------------------------------------------------------------------------
	bindCustomInputs() {
		this.customInputs.forEach( input => {
			input.addEventListener( 'input', () => {
				const val = parseFloat( input.value );
				if ( ! isNaN( val ) && val > 0 ) {
					this.currentAmount = val;
					this.updateSubmitLabel();
				}
			} );

			// Custom-Radio aktivieren wenn Input fokussiert
			input.addEventListener( 'focus', () => {
				const radio = input.closest( '.dona-amount-option' )?.querySelector( 'input[type="radio"]' );
				if ( radio ) radio.checked = true;
			} );
		} );
	}

	// ---------------------------------------------------------------------------
	// Zahlungsmethoden
	// ---------------------------------------------------------------------------
	bindPaymentMethods() {
		document.querySelectorAll( '.dona-payment-option input[type="radio"]' ).forEach( radio => {
			radio.addEventListener( 'change', () => {
				// Apple Pay nur mit Stripe verfügbar — Hinweis einblenden
				if ( radio.value === 'applepay' ) {
					this.showPaymentNote( 'Apple Pay wird über Stripe abgewickelt.' );
				} else {
					this.hidePaymentNote();
				}
			} );
		} );
	}

	showPaymentNote( msg ) {
		let note = document.getElementById( 'payment-note' );
		if ( ! note ) {
			note = document.createElement( 'p' );
			note.id        = 'payment-note';
			note.className = 'dona-payment-note';
			document.querySelector( '.dona-payment-methods' )?.after( note );
		}
		note.textContent = msg;
	}

	hidePaymentNote() {
		document.getElementById( 'payment-note' )?.remove();
	}

	// ---------------------------------------------------------------------------
	// Submit-Button Label
	// ---------------------------------------------------------------------------
	updateSubmitLabel() {
		if ( ! this.submitAmount ) return;
		const formatted = new Intl.NumberFormat( 'de-AT', {
			style:    'currency',
			currency: 'EUR',
		} ).format( this.currentAmount || 0 );

		this.submitAmount.textContent = formatted;
	}

	// ---------------------------------------------------------------------------
	// Default-Betrag des aktiven Tabs
	// ---------------------------------------------------------------------------
	getDefaultAmount( freq ) {
		const panel  = document.getElementById( `amounts-${freq}` );
		const checked = panel?.querySelector( 'input[type="radio"]:checked' );
		return checked && checked.value !== 'custom' ? parseFloat( checked.value ) : 10;
	}
}

new DonationForm();
