declare const confirmation: string;

(() => {
  const form = document.getElementById('deleteForm') as HTMLFormElement | null;
  const input = document.getElementById('confirmation') as HTMLInputElement | null;
  const submit = document.getElementById('deleteSubmit');

  if (!form || !submit) {
    return;
  }

  if(input)
    input.removeAttribute('data-error');

  submit.addEventListener('click', () => {
    if(input) {
      if (input.value.toLowerCase() === confirmation.toLowerCase()) {
        input.removeAttribute('data-error');
        form.submit();
      } else {
        input.setAttribute('data-error', '');
      }
    } else {
      form.submit();
    }
  });
})();
