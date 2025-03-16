document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('form[id^="submitForm-"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            let modalId = this.id.split('-')[1]; // application ID を取得
            let errorContainer = document.getElementById("error-messages-" + modalId);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert('Submission successful!');
                    document.getElementById("projectStatusModal-" + modalId).classList.remove("show");
                    window.location.reload(); // ページリロード
                } else if (data.error) {
                    console.error("Server Error:", data.error);
                    console.error("Trace:", data.trace);
                    errorContainer.innerHTML = `<p>${data.error}</p>`;
                    errorContainer.classList.remove("d-none");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                errorContainer.innerHTML = "<p>File submission failed. Please try again.</p>";
                errorContainer.classList.remove("d-none");
            });
        });
    });
});
