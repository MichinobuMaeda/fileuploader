@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card mb-3">
                <div class="card-header">Upload</div>

                <div class="card-body">
                    <form
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('users.files.create', [ 'user' => Auth()->user()->id ]) }}"
                    >
                        @csrf

                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="file" name="file" onchange="onFileChange()">
                            <label id="fileLabel" class="custom-file-label" for="content"></label>
                        </div>

                        <input class="form-control mb-3" type="text" id="name" name="name" placeholder="File name (optional)" />

                        <div>
                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Uploaded Files
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.files.delete', [ 'user' => Auth()->user()->id]) }}">
                        @method("DELETE")
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt"></i> Delete selected files
                        </button>
                        @foreach($files as $file)
                            <div class="form-check py-2 ml-2">
                                <input class="form-check-input delete-check-input" type="checkbox" name="files[]" value="{{ $file }}" id="file_{{ $file }}">
                                <label class="form-check-label pl-2" for="file_{{ $file }}">
                                    <a
                                        href="{{ route('users.files.show', [ 'file' => $file, 'user' => Auth()->user()->id ])  }}"
                                        target="_blank"
                                        rel="noreferrer"
                                    >{{ $file }}</a>
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function onFileChange () {
        var fileName = document.getElementById('file').value;
        document.getElementById('fileLabel').innerHTML = fileName;
    }
</script>
@endsection
