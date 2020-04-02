<div class="modal" id="{{ $id }}-modal" aria-hidden="true">
  <div class="modal-overlay" tabindex="-1" data-micromodal-close>
    <div class="modal-container" role="dialog" aria-modal="true" aria-labelledby="{{ $id }}-title">
      <header class="modal-header">
        <h3 id="{{ $id }}-title">
          {{ $title }}
        </h3>
        <button aria-label="Close modal" data-micromodal-close>
          <i class="fas fa-times"></i>
        </button>
      </header>
      <div class="modal-content">
        {{ $slot  }}
      </div>
    </div>
  </div>
</div>
