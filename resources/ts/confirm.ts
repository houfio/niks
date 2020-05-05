declare const confirmation: string;

(() => {
  const form = document.getElementById('deleteForm') as HTMLFormElement | null;
  const input = document.getElementById('confirmation') as HTMLInputElement | null;
  const submit = document.getElementById('deleteSubmit');

  if (!form || !input || !submit) {
    return;
  }

  input.removeAttribute('data-error');

  submit.addEventListener('click', () => {
    if (input.value.toLowerCase() === confirmation) {
      input.removeAttribute('data-error');
      form.submit();
    } else {
      input.setAttribute('data-error', '');
    }
  });
})();
