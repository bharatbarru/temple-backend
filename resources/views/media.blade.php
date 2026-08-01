@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Media Library</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <form class="mb-4" method="POST" action="{{ url('admin/upload-media') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="file" name="image[]" class="form-control" multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                        <button type="submit" class="btn btn-primary">Upload Files</button>
                    </div>
                </form>

                <div class="row">
                    @foreach ($files as $file)
                        <div class="col-md-2 col-sm-4 mb-3">
                            <div class="gallery-block">
                                <a href="{{ url('admin/remove-media/' . $file['filename']) }}" 
                                   class="btn btn-danger btn-sm delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete {{$file['filename']}}?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                
                                <span class="copy-url" 
                                      onclick="copyToClipboard('{{ asset('images/media/' . $file['filename']) }}')"
                                      title="Click to copy URL">
                                    Copy URL
                                </span>

                                @if (in_array($file['extension'], ['jpg', 'jpeg', 'png', 'gif']))
                                    <a href="{{ asset('images/media/' . $file['filename']) }}" target="_blank">
                                        <img src="{{ asset('images/media/' . $file['filename']) }}" 
                                             alt="{{ $file['filename'] }}" 
                                             class="img-fluid">
                                    </a>
                                @else
                                    <a href="{{ asset('images/media/' . $file['filename']) }}" 
                                       target="_blank" 
                                       class="file-preview">
                                        <span>{{ strtoupper($file['extension']) }}<br>{{ $file['filename'] }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
<script>
    // Configure Toastr options
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 3000
    };

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            toastr.success('URL copied to clipboard!');
        }).catch(err => {
            toastr.error('Failed to copy URL');
            console.error('Failed to copy: ', err);
        });
    }
</script>
@endpush
