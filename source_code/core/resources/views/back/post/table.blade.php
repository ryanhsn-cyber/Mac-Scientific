@foreach($datas as $data)
<tr id="blog-bulk-delete">
    <td><input type="checkbox" class="bulk-item" value="{{$data->id}}"></td>

  <td>
      @php
          $decoded = json_decode($data->photo, true);
          $photoPath = is_array($decoded) && count($decoded) > 0 ? $decoded[array_key_first($decoded)] : (is_string($decoded) ? $decoded : $data->photo);
          $photoPath = str_replace(['"', "'"], '', $photoPath);
          $photoPath = empty($photoPath) ? 'placeholder.png' : $photoPath;
      @endphp
      <img src="{{ asset('assets/images/' . $photoPath) }}" alt="">

  </td>
    <td>
        {{ $data->title }}
    </td>
    <td>
        {{ $data->category->name }}
    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="{{ route('back.post.edit',$data->id) }}">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('back.post.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
