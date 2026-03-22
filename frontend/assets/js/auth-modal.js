const logoutBtn = document.getElementById("logoutBtn");
const logoutModal = document.getElementById("logoutModal");
const closeModal = document.getElementById("closeModal");

// OPEN MODAL (when logout icon is clicked)
logoutBtn.addEventListener("click", function(e) {
    e.preventDefault(); // prevent # jump
    logoutModal.classList.add("show");
});

// CLOSE MODAL (click X)
closeModal.addEventListener("click", function() {
    logoutModal.classList.remove("show");
});

// CLOSE MODAL (click outside card)
window.addEventListener("click", function(e) {
    if (e.target === logoutModal) {
        logoutModal.classList.remove("show");
    }
});

document.addEventListener("DOMContentLoaded", () => {

    // ===== MODALS =====
    const loginModal = document.getElementById("logoutModal");
    const signupModal = document.getElementById("signupModal");
    const forgotModal = document.getElementById("forgotModal");

    // ===== BUTTONS =====
    const logoutBtn = document.getElementById("logoutBtn");

    const closeLogin = document.getElementById("closeModal");
    const closeSignup = document.getElementById("closeSignup");
    const closeForgot = document.getElementById("closeForgot");

    // SWITCH LINKS
    const openSignup = document.getElementById("openSignup");
    const openLogin = document.getElementById("openLogin");
    const openForgot = document.getElementById("openForgot");
    const backToLogin = document.getElementById("backToLogin");

    // ===== HELPER FUNCTIONS =====
    function closeAll() {
        loginModal.classList.remove("show");
        signupModal.classList.remove("show");
        forgotModal.classList.remove("show");
    }

    function openModal(modal) {
        closeAll();
        modal.classList.add("show");
    }

    // ===== OPEN LOGIN FROM NAV =====
    if (logoutBtn) {
        logoutBtn.addEventListener("click", (e) => {
            e.preventDefault();
            openModal(loginModal);
        });
    }

    // ===== CLOSE BUTTONS =====
    closeLogin?.addEventListener("click", closeAll);
    closeSignup?.addEventListener("click", closeAll);
    closeForgot?.addEventListener("click", closeAll);

    // ===== SWITCH MODALS =====
    openSignup?.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(signupModal);
    });

    openLogin?.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(loginModal);
    });

    openForgot?.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(forgotModal);
    });

    backToLogin?.addEventListener("click", (e) => {
        e.preventDefault();
        openModal(loginModal);
    });

    // ===== CLICK OUTSIDE TO CLOSE =====
    window.addEventListener("click", (e) => {
        if (e.target === loginModal || 
            e.target === signupModal || 
            e.target === forgotModal) {
            closeAll();
        }
    });

    // ===== ESC KEY CLOSE =====
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeAll();
        }
    });

});