function signup(event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append("full_name", document.getElementById("fullname").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("username", document.getElementById("signupUsername").value);
    formData.append("password", document.getElementById("signupPassword").value);

    fetch("../../../backend/signup.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);

        if (data.success) {
            // RESET FORM FIELDS
            document.getElementById("signupForm").reset();

            // CLOSE signup modal
            document.getElementById("signupModal").classList.remove("show");

            // OPEN login modal
            document.getElementById("logoutModal").classList.add("show");
        }
    })
}