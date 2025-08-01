export function tab() {
    const tabLinks = document.querySelectorAll('.tab__link');

    for (const tabLink of tabLinks) {
        tabLink.addEventListener('click', function (e) {
            e.preventDefault();
            tabLinks.forEach(function (el) {
                el.parentElement.classList.remove('sidebar__list-item--active');
            });

            document.querySelectorAll('.tab__content').forEach(function (el) {
                el.style.display = 'none';
            });

            e.target.parentElement.classList.add('sidebar__list-item--active');

            localStorage.setItem('tab-selected', e.target.dataset.id);

            document.getElementById(e.target.dataset.id).style.display = 'block';
        });
    }
}
