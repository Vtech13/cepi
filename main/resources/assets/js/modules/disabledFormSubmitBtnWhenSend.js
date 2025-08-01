export function disabledFormSubmitBtnWhenSend() {
    for (const form of document.forms) {
        form.addEventListener('submit', function (e) {
            const button = e.target.querySelector('button[type="submit"]');
            const input = e.target.querySelector('input[type="submit"]');

            if (button) {
                button.disabled = true;
            }

            if (input) {
                input.disabled = true;
            }
        });
    }
}
