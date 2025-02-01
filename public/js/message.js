document.addEventListener("DOMContentLoaded", function () {
    const message = document.querySelector(".message");
    if (message) {
        let timeout;

        const removeMessage = () => {
            message.style.opacity = 0;
            setTimeout(() => {
                message.remove();
            }, 1000);
        };

        const resetTimeout = () => {
            clearTimeout(timeout);
        };

        const startTimeout = () => {
            timeout = setTimeout(removeMessage, 25000);
        };

        message.addEventListener("mouseenter", resetTimeout);
        message.addEventListener("mouseleave", startTimeout);

        startTimeout();
    }
});
