(() => {
  const buttons = document.querySelectorAll<HTMLElement>('[data-toggle]')

  buttons.forEach((button) => {
    const target = button.dataset.toggle!;
    const icon = button.children[0] as HTMLElement;

    button.addEventListener('click', () => {
      const plus = icon.classList.contains('fa-plus');
      const targets = document.querySelectorAll<HTMLElement>(`[data-parent="${target}"]`);

      icon.classList.replace(plus ? 'fa-plus' : 'fa-minus', plus ? 'fa-minus' : 'fa-plus');

      targets.forEach((child) => {
        child.style.display = child.style.display === 'none' ? 'block' : 'none';
      });
    });
  });
})();
