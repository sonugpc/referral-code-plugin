(function($) {
    'use strict';

    // AJAX load more functionality
    $(document).on('click', '.bt-load-more-btn', function(e) {
        e.preventDefault();

        var $button = $(this);
        var $container = $button.closest('.bt-referral-grid');
        var $gridContainer = $container.find('.bt-referral-grid-container');
        var $spinner = $container.find('.bt-loading-spinner');
        var currentPage = parseInt($button.data('page'));
        var maxPages = parseInt($button.data('max-pages'));
        var postsPerPage = parseInt($container.data('posts-per-page'));
        var category = $container.data('category');

        // Show loading spinner
        $spinner.show();
        $button.prop('disabled', true).text('Loading...');

        $.ajax({
            url: rcp_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_referral_codes',
                page: currentPage,
                posts_per_page: postsPerPage,
                category: category
            },
            success: function(response) {
                if (response.success) {
                    // Append new posts
                    $gridContainer.append(response.data.html);

                    // Update page number
                    $button.data('page', currentPage + 1);

                    // Hide load more button if no more posts
                    if (!response.data.has_more || currentPage + 1 >= maxPages) {
                        $button.hide();
                    }
                } else {
                    console.error('AJAX error:', response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            },
            complete: function() {
                // Hide loading spinner and re-enable button
                $spinner.hide();
                $button.prop('disabled', false).text('Load More');
            }
        });
    });

    // Copy referral code functionality
    window.copyReferralCode = function(button, code) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(function() {
                showToast('Code copied to clipboard!', 'success');
                animateCopyButton(button);
                trackMainCodeUsage(button);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
                fallbackCopyTextToClipboard(code);
                showToast('Code copied to clipboard!', 'success');
                animateCopyButton(button);
                trackMainCodeUsage(button);
            });
        } else {
            fallbackCopyTextToClipboard(code);
            showToast('Code copied to clipboard!', 'success');
            animateCopyButton(button);
            trackMainCodeUsage(button);
        }
    };

    // Track main referral code usage (for archive/grid pages)
    function trackMainCodeUsage(button) {
        // This is for main codes in the grid - we don't track individual usage here
        // as it's already tracked on page view for single posts
        console.log('Main code copied');
    }

    function fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
        } catch (err) {
            console.error('Fallback: Oops, unable to copy', err);
        }

        document.body.removeChild(textArea);
    }

    function animateCopyButton(button) {
        var $button = $(button);
        $button.addClass('copied');
        setTimeout(function() {
            $button.removeClass('copied');
        }, 2000);
    }

    function showToast(message, type) {
        // Remove existing toasts
        $('.bt-toast').remove();

        var toastClass = type === 'success' ? 'bt-toast-success' : 'bt-toast-error';
        var $toast = $('<div class="bt-toast ' + toastClass + '">' + message + '</div>');

        $('body').append($toast);

        // Trigger animation
        setTimeout(function() {
            $toast.addClass('show');
        }, 10);

        // Remove toast after 3 seconds
        setTimeout(function() {
            $toast.removeClass('show');
            setTimeout(function() {
                $toast.remove();
            }, 300);
        }, 3000);
    }

})(jQuery);
