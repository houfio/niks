(() => {
  const buttons = document.querySelectorAll<HTMLElement>('[data-remove]');

  buttons.forEach((button) => {
    const remove = button.dataset.remove!;

    button.addEventListener('click', () => {
      const targets = document.querySelectorAll<HTMLElement>(`[data-anchor="${remove}"]`);

      targets.forEach((target) => target.remove());
    });
  })
})();
