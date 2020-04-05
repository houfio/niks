import { createPopper, Instance } from '@popperjs/core';
import * as autosize from 'autosize';
import MicroModal from 'micromodal';

const showEvents = ['mouseenter', 'focus'];
const hideEvents = ['mouseleave', 'blur'];

(() => {
  MicroModal.init();
  autosize(document.querySelectorAll('textarea'));

  document.querySelectorAll<HTMLElement>('[data-tooltip]').forEach((source) => {
    const target = document.getElementById(source.dataset.tooltip || '');

    if (!target) {
      return;
    }

    let popper: Instance;

    showEvents.forEach(event => source.addEventListener(event, () => {
      target.setAttribute('data-show', '');
      popper = create(source, target);
    }));
    hideEvents.forEach(event => source.addEventListener(event, () => {
      target.removeAttribute('data-show');

      if (popper) {
        destroy(popper, target);
      }
    }));
  });

  document.querySelectorAll<HTMLElement>('.flash').forEach((element) => {
    const hide = () => element.classList.add('dismissed');

    element.addEventListener('click', hide);
    setTimeout(hide, 5000);
  });
})();

function create(source: HTMLElement, target: HTMLElement) {
  return createPopper(source, target, {
    modifiers: [{
      name: 'offset',
      options: {
        offset: [0, 8]
      }
    }]
  });
}

function destroy(popper: Instance, target: HTMLElement) {
  target.addEventListener('transitionend', popper.destroy, {
    once: true
  });
}
