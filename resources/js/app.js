const dialog = document.getElementById('confirm-dialog');
let pendingForm = null;

if (dialog) {
    // any form with a data-confirm attribute opens the modal instead of submitting right away
    document.addEventListener('submit', (event) => {
        const form = event.target;

        if (!form.dataset.confirm) {
            return;
        }

        event.preventDefault();
        pendingForm = form;

        document.getElementById('confirm-title').textContent = form.dataset.confirmTitle ?? 'Are you sure?';
        document.getElementById('confirm-message').textContent = form.dataset.confirm;

        dialog.showModal();
    });

    document.getElementById('confirm-ok').addEventListener('click', () => {
        dialog.close();
        pendingForm?.submit();
    });

    document.getElementById('confirm-cancel').addEventListener('click', () => {
        dialog.close();
        pendingForm = null;
    });

    // clicking the dark backdrop also cancels
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) {
            dialog.close();
            pendingForm = null;
        }
    });
}