@foreach($children as $child)
  <option value="{{ $child['id'] }}" @if(isset($category) && $category->parent_id == $child['id']) selected @endif>
    @for($i = 0; $i < $depth; $i++)
        &nbsp;&nbsp;
    @endfor
    {{ $child['category'] }}
  </option>
  <x-select-category :parent="$child['id']" :children="$child['children']" :depth="$depth + 2"/>
@endforeach
