export function initNewsletterForm() {
  const form = document.querySelector('.newsletter-section__form');
  if (!form) return;

  const feedback = form.querySelector('.newsletter-section__feedback');
  const submitBtn = form.querySelector('[type="submit"]');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    submitBtn.disabled = true;
    if (feedback) {
      feedback.textContent = '';
      feedback.className = 'newsletter-section__feedback';
    }

    const formData = new FormData(form);
    formData.append('action', 'fjdf_newsletter_subscribe');

    try {
      const res = await fetch(fjdfData.ajaxUrl, { method: 'POST', body: formData });
      const data = await res.json();

      if (!data.success) throw new Error(data.data?.message || 'Fehler beim Absenden.');

      if (feedback) {
        feedback.textContent = data.data.message;
        feedback.classList.add('is-success');
      }
      form.reset();
    } catch (err) {
      if (feedback) {
        feedback.textContent = err.message;
        feedback.classList.add('is-error');
      }
    } finally {
      submitBtn.disabled = false;
    }
  });
}