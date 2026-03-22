function showToast(message, type = "success") {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className = "toast show " + type;

    setTimeout(() => {
        toast.className = "toast";
    }, 3000);
}

function login(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append("username", document.getElementById("loginUsername").value);
    formData.append("password", document.getElementById("password").value);

    fetch("/jasaan-tourism/backend/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        showToast(data.message, data.success ? "success" : "error");

        if (data.success) {
            if (data.role === "admin") {
                window.location.href = "/jasaan-tourism/frontend/pages/admin/admin_dashboard.php";
            } else {
                window.location.href = "/jasaan-tourism/frontend/pages/user/user_explore.php";
            }
        }
    })
    .catch(err => console.error("Login error:", err));
}