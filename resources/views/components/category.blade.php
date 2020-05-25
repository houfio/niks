@foreach($children as $child)
  <div
    @if(isset($parent)) data-parent="{{ $parent }}" style="display: none" @endif
  >
    <div class="category" style="margin-left: {{ $depth }}rem">
      <input
        id="category_{{ $child['id'] }}"
        name="categories[]"
        type="checkbox"
        value="{{ $child['id'] }}"
        @if(in_array($child['id'], request()->get('categories') ?? [])) checked @endif
      />
      <label for="category_{{ $child['id'] }}">{{ $child['category'] }}</label>
      @if(count($child['children']))
        <button type="button" data-toggle="{{ $child['id'] }}">
          <i class="fas fa-plus"></i>
        </button>
      @endif
    </div>
    <x-category :parent="$child['id']" :children="$child['children']" :depth="$depth + 1"/>
  </div>
@endforeach
