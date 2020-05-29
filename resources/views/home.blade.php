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
                        <div>
                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Uploaded Files</div>

                <div class="card-body">
                @foreach($files as $file)
                    <div>
                        <a
                            href="{{ route('users.files.show', [ 'file' => $file, 'user' => Auth()->user()->id ])  }}"
                            target="_blank"
                            rel="noreferrer"
                        >{{ $file }}</a>
                    </div>
                @endforeach
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
