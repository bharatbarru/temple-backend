@php
    $files = File::files(public_path('images/media'));
@endphp

<h1>Choose File</h1>

<ul>
    @foreach ($files as $file)
        <li>
            <a href="#" onclick="returnFileUrl('{{ asset('images/media/'. $file->getFilename()) }}')">
                @php($extension = pathinfo($file, PATHINFO_EXTENSION))
                
                @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                    <img src="{{ asset('images/media/'. $file->getFilename()) }}" alt="" height="100" />
                @else
                    {{ basename($file) }}
                @endif
            </a>
        </li>
    @endforeach
</ul>

<script>
    function returnFileUrl(fileUrl) {
        var funcNum = getUrlParam('CKEditorFuncNum');
        window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
        window.close();
    }

    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);
        return (match && match.length > 1) ? match[1] : null;
    }
</script>
