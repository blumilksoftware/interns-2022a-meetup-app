import Alpine from 'alpinejs';
import Editor from '@toast-ui/editor'
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';


const editor = new Editor({
    el: document.querySelector('#editor'),
    height: '400px',
    initialEditType: 'markdown',
    placeholder: 'Write something cool!',
})

if (document.querySelector('#createNews')) {
    document.querySelector('#createNews').addEventListener('submit', event => {
        event.preventDefault();
        document.querySelector('#text').value = editor.getMarkdown();
        event.target.submit();
    });
}

if (document.querySelector('#editNews')) {
    editor.setMarkdown(document.querySelector('#oldText').value);

    document.querySelector('#editNews').addEventListener('submit', event => {
        event.preventDefault();
        document.querySelector('#text').value = editor.getMarkdown();
        event.target.submit();
    });
}

window.Alpine = Alpine;

Alpine.start();
