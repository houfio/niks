(() => {
  const button = document.getElementById('delete-images');
  const input = document.getElementById('images[]') as HTMLFormElement | null;

  if (!input) {
    return;
  }

  if (input.parentNode) {
    (input.parentNode as HTMLElement).style.display = 'none';
  }

  if (!button) {
    return;
  }

  button.addEventListener('click', (e) => {
    if (!input.parentNode) {
      return;
    }

    e.preventDefault();
    button.style.display = 'none';
    (input.parentNode as HTMLElement).style.display = 'block';

    const images = document.querySelectorAll<HTMLElement>('input[type="hidden"][name="delete_images"');

    images.forEach((image) => image.parentNode && image.parentNode.removeChild(image));
  });
})();
