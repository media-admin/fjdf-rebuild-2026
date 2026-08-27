document.addEventListener('click', (e) => {
	const trigger = e.target.closest('.js-open-donation-modal');
	if (!trigger) return;
	e.preventDefault();

	document.querySelector('.givewp-donation-form-modal__open')?.click();
});