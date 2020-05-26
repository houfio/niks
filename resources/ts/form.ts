(() => {
  const parent = document.getElementById('parent') as HTMLSelectElement | null;
  const type = document.getElementById('type') as HTMLSelectElement | null;

  if (!parent || !type) {
    return;
  }

  const opt = parent.selectedIndex;
  type.disabled = opt !== 0;

  parent.addEventListener('change', () => {
    const opt = parent.selectedIndex;
    type.disabled = opt !== 0;
  });
})();
