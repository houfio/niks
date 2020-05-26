@foreach($children as $child)
  <div @if(isset($parent)) data-parent="{{ $parent }}" style="display: none" @endif>
    <div class="category" style="margin-left: {{ $depth }}rem">
      <input
        id="category_{{ $child['id'] }}"
        name="{{ isset($single) ? 'category' : 'categories[]' }}"
        type="{{ isset($single) ? 'radio' : 'checkbox' }}"
        value="{{ $child['id'] }}"
        @if(in_array($child['id'], request()->get('categories') ?? $value ?? []) || $child['id'] === ($current ?? null)) checked @endif
        @if(isset($disable) && $disable === $child['id']) disabled @endif
      />
      <label for="category_{{ $child['id'] }}">{{ $child['category'] }}</label>
      @if(count($child['children']))
        <button type="button" data-toggle="{{ $child['id'] }}">
          <i class="fas fa-plus"></i>
        </button>
      @endif
    </div>
    <x-category
      :parent="$child['id']"
      :children="$child['children']"
      :depth="$depth + 1"
      :value="$value ?? null"
      :single="$single ?? null"
      :disable="$disable ?? null"
      :current="$current ?? null"
    />
  </div>
@endforeach
