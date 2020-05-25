<div>
  ---
  @foreach($children as $child)
    {{ $child->category }}
    <x-category :children="$child->children"/>
  @endforeach
</div>
