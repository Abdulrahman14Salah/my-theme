jQuery(document).ready(function ($) {
    // AJAX Load More
    var page = 2;
    var loading = false;
    var $container = $('#main-posts-container'); // Ensure your archive loop has this ID
    var $button = $('#load-more-posts');

    $button.on('click', function () {
        if (!loading) {
            loading = true;
            $button.addClass('loading').text('Loading...');

            var data = {
                'action': 'load_more_posts',
                'page': page,
                'nonce': a_salah_ajax.nonce
            };

            $.post(a_salah_ajax.ajax_url, data, function (response) {
                if (response.success) {
                    $container.append(response.data);
                    page++;
                    loading = false;
                    $button.removeClass('loading').text('Load More');
                } else {
                    $button.remove(); // No more posts
                }
            }).fail(function () {
                console.log('Error loading posts');
                loading = false;
            });
        }
    });

    // Lazy Loading (Native + Fallback)
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    } else {
        // Fallback for older browsers could go here
    }

    // Scroll Animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('article, .widget, .wp-block-column').forEach(el => {
        el.classList.add('fade-in-scroll');
        observer.observe(el);
    });

    // Smooth Scroll
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function (event) {
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function () {
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) {
                        return false;
                    } else {
                        $target.attr('tabindex', '-1');
                        $target.focus();
                    };
                });
            }
        }
    });
});
