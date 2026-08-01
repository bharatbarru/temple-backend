@push('page_scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

            tinymce.init({
                target: document.getElementById('{{ $field }}'), // Use direct target to support numeric-leading IDs
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
                editimage_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | align numlist bullist | link image | table media | lineheight outdent indent | ltr rtl",
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                link_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_list: [
                    { title: 'My page 1', value: 'https://www.tiny.cloud' },
                    { title: 'My page 2', value: 'http://www.moxiecode.com' }
                ],
                image_class_list: [
                    { title: 'None', value: '' },
                    { title: 'Some class', value: 'class-name' }
                ],
                importcss_append: true,
                file_picker_callback: (callback, value, meta) => {
                    // File picker callback logic
                    if (meta.filetype === 'file') {
                        callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                    } else if (meta.filetype === 'image') {
                        callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                    } else if (meta.filetype === 'media') {
                        callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                    }
                },
                height: 400,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image table',
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',
                content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px; }',
                promotion: false,
                // Added options to retain relative URLs
                relative_urls: true, // Retain relative URLs
                remove_script_host: false, // Do not remove the host part of URLs
                convert_urls: false // Disable automatic URL conversion
            });
        });
    </script>
@endpush