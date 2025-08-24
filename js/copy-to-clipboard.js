document.addEventListener('DOMContentLoaded', function () {
    const copyIcons = document.querySelectorAll('.rcp-copy-icon');

    copyIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            const textToCopy = this.getAttribute('data-clipboard-text');
            navigator.clipboard.writeText(textToCopy).then(() => {
                // Optional: Add a tooltip or other feedback to indicate success
                const originalTitle = this.getAttribute('title');
                this.setAttribute('title', 'Copied!');
                setTimeout(() => {
                    this.setAttribute('title', originalTitle);
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });
    });
});
