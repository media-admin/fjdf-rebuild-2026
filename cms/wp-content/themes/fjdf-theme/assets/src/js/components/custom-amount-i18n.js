(function () {
	const translations = {
		de: 'Individuellen Betrag eingeben',
		en: 'Enter custom amount',
		es: 'Ingresar monto personalizado',
	};

	const currentLang = document.documentElement.lang.split('-')[0] || 'de';
	const text = translations[currentLang] || translations.de;

	const patchField = (input) => {
		if (input.placeholder !== text) {
			input.placeholder = text;
		}
	};

	// Bereits vorhandene Felder sofort patchen (falls Formular schon offen)
	document.querySelectorAll('.givewp-fields-amount__input-custom').forEach(patchField);

	// Neu eingefügte Felder beobachten (Modal öffnet sich ja erst bei Klick)
	const observer = new MutationObserver(() => {
		document.querySelectorAll('.givewp-fields-amount__input-custom').forEach(patchField);
	});

	observer.observe(document.body, { childList: true, subtree: true });
})();