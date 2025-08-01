import axios from "axios";
import slide from "./modules/slide";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


if (document.querySelector('.textarea-editor')) {
    for (let editor of document.querySelectorAll('.textarea-editor')) {
        ClassicEditor.create(editor, {
            toolbar: {
                items: [
                    'bold',
                    'italic',
                    '|',
                    'fontSize',
                    '|',
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'alignment',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'removeFormat'
                ]
            },
            language: 'en',
            licenseKey: '',
            link: {
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: 'Open in a new tab',
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    }
                }
            }
        })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }
}

if (document.querySelector('.js__input-filter')) {
    const inputFilter = document.querySelectorAll('.js__input-filter')

    for (let input of inputFilter) {
        input.addEventListener('keyup', (e) => {
            filterCustom(input.value, document.getElementsByTagName("tr"));
        })
    }

    function filterCustom(value, $rows) {
        let filter, i, txtValue;

        filter = value.toUpperCase();

        for (i = 0; i < $rows.length; i++) {
            txtValue = $rows[i].textContent || $rows[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                $rows[i].style.display = "";
            } else {
                $rows[i].style.display = "none";
            }
        }
    }
}


if (document.getElementById('js-delete-attachment')) {
    document.getElementById('js-delete-attachment').addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('destroy-attachment').submit();
    });
}

if (document.querySelector('.js__delete-attachment')) {
    for (let btnDelete of document.querySelectorAll('.js__delete-attachment')) {
        btnDelete.addEventListener('click', (e) => {
            e.preventDefault();

            if (confirm('Are your sure to delete this?')) {
                axios.delete(btnDelete.dataset.url)
                    .then(_ => {
                        document.querySelector('.' + btnDelete.dataset.class).style.display = 'none';
                    })
                    .catch((err) => {
                        console.error(err);
                    })
            }
        });
    }
}

if (document.querySelector('.js__btn-confirm')) {
    for (let btn of document.querySelectorAll('.js__btn-confirm')) {
        btn.addEventListener('click', (e) => {
            if (!confirm(btn.dataset.confirm)) {
                e.preventDefault();
            }
        })
    }
}

if (document.querySelector('.js__toggle-btn')) {
    for (let btn of document.querySelectorAll('.js__toggle-btn')) {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            let key = btn.dataset.key;

            slide.slideToggle(document.querySelector('.js__toggle-value-' + key));
        });
    }
}
