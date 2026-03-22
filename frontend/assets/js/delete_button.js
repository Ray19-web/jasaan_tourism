function deleteFeedback(id) {
    if (!confirm("Delete this feedback?")) return;

    fetch("/jasaan-tourism/backend/delete_feedback.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + id
    })
    .then(res => res.json())
    .then(() => location.reload());
}