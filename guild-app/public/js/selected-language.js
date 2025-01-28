document.addEventListener("DOMContentLoaded", function(){
    const selectBox = document.getElementById("language");
    const displayArea = document.getElementById("selectedLanguage");

    selectBox.selectedIndex = 0;

    selectBox.addEventListener("change",function(){
        const selectedValue = this.value;

        if(selectedValue){
            const existingBadge = document.querySelector(`.badge[data-value="${selectedValue}"]`);
            const selectedOption = selectBox.querySelector(`option[value="${selectedValue}"]`);

            if(existingBadge){
                existingBadge.remove();
                selectedOption.classList.remove("selected-option");
                selectedOption.textContent = selectedValue;
            }else{
                const badge = document.createElement("span");
                badge.className = "badge bg-secondary me-2 mt-2 p-2";
                badge.dataset.value = selectedValue;
                badge.innerHTML = `${selectedValue} <span class="remove-badge" style="cursor:pointer; margin-left: 5px;">&times;</span>`;

                badge.querySelector(".remove-badge").addEventListener("click", function(event){
                    event.stopPropagation();
                    badge.remove();
                    selectedOption.classList.remove("selected-option");
                    selectedOption.textContent = selectedValue;

                });

                displayArea.appendChild(badge);
                selectedOption.textContent = `${selectedValue} (selected)`;
            }

            this.value = "";
        }
    })
})
