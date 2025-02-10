document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll(".favoriteBtn").forEach(function (btn){
        btn.addEventListener("click", function(e){
            e.preventDefault();
            let projectId = this.dataset.project_id;
            let icon = this.querySelector("i");

            fetch(`/project/${projectId}/favorite`,{
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if(data.favorite){
                    icon.classList.remove("fa-regular");
                    icon.classList.add("fa-solid");
                }else{
                    icon.classList.remove("fa-solid");
                    icon.classList.add("fa-regular");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});
