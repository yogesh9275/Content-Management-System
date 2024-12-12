import './bootstrap';
// Import Quill
import Quill from 'quill';

// Import Quill's CSS (make sure this is included)
import 'quill/dist/quill.snow.css'; // Or 'quill.bubble.css' for bubble theme

// Initialize Quill editor on page load
document.addEventListener('DOMContentLoaded', function () {
    const editor = new Quill('#details', {
        theme: 'snow', // Snow theme or 'bubble' theme
        modules: {
            toolbar: [
                [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['bold', 'italic', 'underline'],
                ['link'],
                [{ 'align': [] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                ['blockquote', 'code-block']
            ]
        }
    });
});
