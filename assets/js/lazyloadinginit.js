document.addEventListener("DOMContentLoaded", function() {
    renderImageLazy();
});

window.renderImageLazy = function(){
    var lazyloadImages;

    if ("IntersectionObserver" in window) {
        lazyloadImages = document.querySelectorAll(".lazy");
        var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var image = entry.target;

                    if (image.getAttribute('data-src')) {
                        var img = new Image();

                        img.onload = function() {
                            image.src = image.dataset.src;
                            image.classList.remove("lazy");
                        }
                        img.onerror = function() {
                            image.src = document.location.origin + '/images/notfound.jpg';
                            image.classList.remove("lazy");
                        }
                        img.src = image.dataset.src;
                    }

                    imageObserver.unobserve(image);
                }
            });
        });

        lazyloadImages.forEach(function(image) {
            imageObserver.observe(image);
        });
    } else {
        var lazyloadThrottleTimeout;
        lazyloadImages = document.querySelectorAll(".lazy");

        function lazyload() {
            if (lazyloadThrottleTimeout) {
                clearTimeout(lazyloadThrottleTimeout);
            }

            lazyloadThrottleTimeout = setTimeout(function() {
                var scrollTop = window.pageYOffset;
                lazyloadImages.forEach(function(img) {
                    if (img.offsetParent.offsetTop < (window.innerHeight + scrollTop) && img.getAttribute('data-src')) {
                        var image = new Image();
                        image.onload = function() {
                            img.src = img.dataset.src;
                            img.classList.remove("lazy");
                        }
                        image.onerror = function() {
                            img.src = document.location.origin + '/images/notfound.jpg';
                            img.classList.remove("lazy");
                        }
                        image.src = img.dataset.src;
                    }
                });
            }, 20);

            lazyloadImages = document.querySelectorAll(".lazy");
            if (lazyloadImages.length == 0) {
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
            }
        }

        lazyload();
        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
    }
};