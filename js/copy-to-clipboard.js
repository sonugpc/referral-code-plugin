document.addEventListener('DOMContentLoaded', function () {
    const copyIcons = document.querySelectorAll('.rcp-copy-icon');

    copyIcons.forEach(icon => {
        const originalIconHTML = icon.innerHTML;
        const checkIconHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>';

        icon.addEventListener('click', function () {
            const textToCopy = this.getAttribute('data-clipboard-text');

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    showCopySuccess(icon, originalIconHTML, checkIconHTML);
                }).catch(err => {
                    console.error('Failed to copy text: ', err);
                    fallbackCopy(textToCopy, icon, originalIconHTML, checkIconHTML);
                });
            } else {
                fallbackCopy(textToCopy, icon, originalIconHTML, checkIconHTML);
            }
        });
    });

    function showCopySuccess(icon, originalIconHTML, checkIconHTML) {
        icon.innerHTML = checkIconHTML;
        setTimeout(() => {
            icon.innerHTML = originalIconHTML;
        }, 2000);
    }

    function fallbackCopy(text, icon, originalIconHTML, checkIconHTML) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.top = '0';
        textArea.style.left = '0';
        textArea.style.width = '2em';
        textArea.style.height = '2em';
        textArea.style.padding = '0';
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';
        textArea.style.background = 'transparent';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showCopySuccess(icon, originalIconHTML, checkIconHTML);
        } catch (err) {
            console.error('Fallback copy failed', err);
        }
        document.body.removeChild(textArea);
    }
});
