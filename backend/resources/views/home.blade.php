@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header font-weight-bold">
            Filter by folder
        </div>
        <div class="card-body">
            <form name="add-blog-post-form" id="add-blog-post-form" method="get" target="_self" action="{{url('/')}}">
                @csrf
                <div class="form-group mb-3">
                    <label for="parent_id">Folder</label>
                    <select class="form-select" name="parent_id" aria-label=" example">
                        <option value="" selected>None</option>
                        @foreach($foldersForForm as $folder)
                            <option value="{{$folder->id}}">{{$folder->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>

    <div class="card mt-3">
        <div class="card-header font-weight-bold">
            List of files and folders
        </div>
        <div class="card-body">
            @include('file-three-view', ['files' => $files])
        </div>

    </div>

    <div class="card mt-3">
        <div class="card-header font-weight-bold">
           Add new folder or file
        </div>
        <div class="card-body">
            <form name="add-blog-post-form" id="add-blog-post-form" method="post" target="_self" action="{{url('files')}}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required="">
                </div>
                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="file" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            File
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="folder">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Folder
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="parent_id">Parent</label>
                    <select class="form-select" name="parent_id" aria-label=" example">
                        <option value="" selected>None</option>
                        @foreach($foldersForForm as $folder)
                            <option value="{{$folder->id}}">{{$folder->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

