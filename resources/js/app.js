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
    document.querySelector('#createNews').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#content').value = editor.getMarkdown();
        e.target.submit();
    });
}
if (document.querySelector('#editNews')) {
    editor.setMarkdown(document.querySelector('#oldContent').value);

    document.querySelector('#editNews').addEventListener('submit', e => {
        e.preventDefault();
        document.querySelector('#content').value = editor.getMarkdown();
        e.target.submit();
    });
}
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
