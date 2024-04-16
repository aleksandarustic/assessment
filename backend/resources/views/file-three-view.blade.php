<ul>
    @foreach($files as $file)
        <li>
            <a>{{$file->name}}</a>
            @if(!empty($file->children) && $file->children->count())
                @include('file-three-view',['files' => $file->children])
            @endif
        </li>
    @endforeach
</ul>
