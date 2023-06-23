const slideUp = document.querySelectorAll(".slide-up");

for (let i = 0; i < slideUp.length; i++) {
    let options = {
        root: null,
        rootMargin: "100px",
        threshold: 0.5,
    };
    let callback = (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                slideUp[i].setAttribute(
                    "style",
                    "opacity: 1; transform: translateY(0);"
                );
            }
        });
    };

    let observer = new IntersectionObserver(callback, options);

    observer.observe(slideUp[i]);
}
