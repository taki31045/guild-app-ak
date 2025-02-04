let selectedLanguages = [];

function toggleDropdown(){
    let dropdown = document.querySelector(".dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function addOrRemoveTag(value, text, optionElement){
    let index = selectedLanguages.indexOf(value);

    if(index === -1 && value !== ""){
        selectedLanguages.push(value);
        updateHiddenInput();

        let tag = document.createElement("div");
        tag.classList.add("tag");
        tag.setAttribute("data-value", value);
        tag.innerHTML = text + '<span onclick="removeTag(this)">x</span>';
        document.querySelector(".selected-tags").appendChild(tag);
        optionElement.classList.add("selected-option");
    }else{
        removeTagByValue(value);
    }
}

function removeTag(span){
    let tag = span.parentElement;
    let value = tag.getAttribute("data-value");
    removeTagByValue(value);
    // document.querySelector(`.dropdown div[data-value="${value}"]`).classList.remove("selected-option");
}

function removeTagByValue(value){
    selectedLanguages = selectedLanguages.filter(lang => lang !== value);
    updateHiddenInput();

    let tagElement = document.querySelector(`.tag[data-value="${value}"]`);
    if(tagElement) tagElement.remove();

    let optionElement = document.querySelector(`.dropdown div[data-value="${value}"]`);
    if(optionElement) optionElement.classList.remove("selected-option");
}

function updateHiddenInput(){
    document.getElementById("selectedLanguages").value = selectedLanguages.join(",");
}

    document.querySelectorAll(".dropdown div[data-value]").forEach(option => {
        option.addEventListener("click", function(e){
            e.stopPropagation(); // 親要素へのクリックイベント伝播を防ぐ
            const value = this.getAttribute("data-value");
            const text = this.innerText;
            addOrRemoveTag(value, text, this);
        });
    });

    document.addEventListener("click", function(event){
        if(!event.target.closest(".select-container")){
            document.querySelector(".dropdown").style.display = "none";
        }
    });






// document.addEventListener("DOMContentLoaded", function(){
//     const selectBox = document.getElementById("language");
//     const displayArea = document.getElementById("selectedLanguage");

//     selectBox.selectedIndex = 0;

//     selectBox.addEventListener("change",function(){
//         const selectedValue = this.value;

//         if(selectedValue){
//             const existingBadge = document.querySelector(`.badge[data-value="${selectedValue}"]`);
//             const selectedOption = selectBox.querySelector(`option[value="${selectedValue}"]`);

//             if(existingBadge){
//                 existingBadge.remove();
//                 selectedOption.classList.remove("selected-option");
//                 selectedOption.textContent = selectedValue;
//             }else{
//                 const badge = document.createElement("span");
//                 badge.className = "badge bg-secondary me-2 mt-2 p-2";
//                 badge.dataset.value = selectedValue;
//                 badge.innerHTML = `${selectedValue} <span class="remove-badge" style="cursor:pointer; margin-left: 5px;">&times;</span>`;

//                 badge.querySelector(".remove-badge").addEventListener("click", function(event){
//                     event.stopPropagation();
//                     badge.remove();
//                     selectedOption.classList.remove("selected-option");
//                     selectedOption.textContent = selectedValue;

//                 });

//                 displayArea.appendChild(badge);
//                 selectedOption.textContent = `${selectedValue} (selected)`;
//             }

//             this.value = "";
//         }
//     })
// })
