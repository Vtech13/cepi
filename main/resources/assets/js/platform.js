import {disabledFormSubmitBtnWhenSend} from "./modules/disabledFormSubmitBtnWhenSend";
import slide from "./modules/slide";
import classList from "./modules/classList";
import "@grafikart/drop-files-element";
import * as basicLightbox from 'basiclightbox';
import {tab} from "./modules/tabs";

disabledFormSubmitBtnWhenSend();
removeFlashMessage();

/**
 * Dropdown element
 */
if (document.querySelectorAll('.dropdown__button').length > 0) {
    dropdownBtn(document.querySelectorAll('.dropdown__button'));
}

document.addEventListener('mouseup', (e) => {
    dropdownBtnClose(e);
});

/**
 * Table responsive
 */
if (document.querySelectorAll('.table-responsive')) {
    setTableResponsive(document.querySelectorAll('.table-responsive'))
}

if (document.querySelector('#search-filter')) {
    document.querySelector('#search-filter').addEventListener('keyup', filterTable, false);
}

if (document.querySelector('#search-filter-li')) {
    document.querySelector('#search-filter-li').addEventListener('keyup', filterLi, false);
}

if (document.getElementById('forgot-password')) {
    document.getElementById('forgot-password').addEventListener('click', function (e) {
        e.preventDefault();
        const containerForgot = document.getElementById('container-forgot-password');
        slide.slideToggle(containerForgot);
    })
}

if (document.querySelector('.js__attachment-delete')) {
    for (const btnDelete of document.querySelectorAll('.js__attachment-delete')) {
        btnDelete.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Êtes-vous sûr de vouloir supprimer ce media ?')) {
                fetch(btnDelete.dataset.url, {
                    headers: defineHeaderForForm('post'),
                    method: 'DELETE'
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(res => {
                        document.getElementById('attachment-' + btnDelete.dataset.id).style.display = 'none';
                    })
                    .catch(err => {
                        console.error(err.message);
                    });
            }
        });
    }
}

/**
 * Lightbox
 */
if (document.querySelectorAll('.js__lightbox-btn').length > 0) {
    lightbox(document.querySelectorAll('.js__lightbox-btn'))
}

if (document.querySelector('.tab__link')) {
    tab();

    if (
        localStorage.getItem('tab-selected') &&
        document.querySelector('[data-id=' + localStorage.getItem('tab-selected') + ']')
    ) {
        document.querySelector('[data-id=' + localStorage.getItem('tab-selected') + ']').click();
    } else {
        document.querySelector('.tab__link').click();
    }
}

/**
 * Delete confrere
 * -------------------
 */
if (document.querySelectorAll('.js__delete-confrere').length > 0) {
    for (const btn of document.querySelectorAll('.js__delete-confrere')) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Êtes-vous sur de vouloir supprimer ce confrère ?')) {
                document.getElementById(this.dataset.id).submit();
            }
        });
    }
}

if (document.querySelectorAll('.js__delete-patient').length > 0) {
    for (const btn of document.querySelectorAll('.js__delete-patient')) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Êtes-vous sur de vouloir supprimer ce patient ?')) {
                document.getElementById(this.dataset.id).submit();
            }
        });
    }
}

/**
 * =====================
 * --FUNCTIONS
 * =====================
 */
/**
 * Remove flash message after 15 second
 */
function removeFlashMessage() {
    if (document.getElementById('flashMessage')) {
        setTimeout(function () {
            if (document.getElementById('flashMessage')) {
                slide.slideUp(document.getElementById('flashMessage'), 800);
            }
        }, 15000)
    }
}

/**
 * Dropdown btn - dropdown menu
 * @param {NodeListOf<Element>} dropdownButton
 */
function dropdownBtn(dropdownButton) {
    for (const btn of dropdownButton) {
        btn.addEventListener('click', () => {
            const content = document.querySelector('.dropdown__content');
            if (classList.hasClass(content, 'open')) {
                classList.removeClass(content, 'open');
            } else {
                content.classList.add('open');
            }
        })
    }
}

function dropdownBtnClose(e) {
    const content = document.querySelector('.dropdown__content.open');

    if (content !== null && !classList.hasClass(e.target, 'dropdown__button')) {
        classList.removeClass(content, 'open');
    }
}

function setTableResponsive(table) {
    table.forEach(function (table) {
        let labels = Array.from(table.querySelectorAll('th')).map(function (th) {
            return th.innerText
        });

        table.querySelectorAll('td').forEach(function (td, i) {
            td.setAttribute('data-label', labels[i % labels.length])
        })
    });
}

function filterTable(event) {
    const filter = event.target.value.toUpperCase();
    const rows = document.querySelector("#table tbody").rows;

    for (let i = 0; i < rows.length; i++) {
        const firstCol = rows[i].cells[0].textContent.toUpperCase();
        const secondCol = rows[i].cells[1].textContent.toUpperCase();
        const thirdCol = rows[i].cells[2].textContent.toUpperCase();
        const fourthCol = rows[i].cells[3].textContent.toUpperCase();
        const fifthCol = rows[i].cells[4].textContent.toUpperCase();

        if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1 || thirdCol.indexOf(filter) > -1 || fourthCol.indexOf(filter) > -1 || fifthCol.indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

function filterLi(event) {
    const filter = event.target.value.toUpperCase();
    const rows = document.querySelectorAll(".sidebar__list-item");

    for (const item of rows) {
        const value = item.textContent.toUpperCase();
        if (value.indexOf(filter) > -1) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    }
}

function defineHeaderForForm(method = 'get') {
    const myHeaders = new Headers();
    myHeaders.append('X-Requested-With', 'XMLHttpRequest')

    if (method === 'post') {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        myHeaders.append('X-CSRF-TOKEN', csrfToken)
    }

    return myHeaders;
}

/**
 * Display lightbox
 * @param {NodeList} btnActivateLightbox
 */
function lightbox(btnActivateLightbox) {
    for (const lightbox of btnActivateLightbox) {
        lightbox.addEventListener('click', function () {
            if (lightbox.dataset.type === 'img') {
                basicLightbox.create(`<img src="` + lightbox.dataset.url + `" alt="">`).show()
            }
        })
    }
}

$('#receiver_id').select2();

