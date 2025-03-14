let selectedLanguages = [];

document.querySelectorAll('.selected-tags .tag').forEach(tag => {
    const value = tag.getAttribute('data-value');
    selectedLanguages.push(value);

    const optionElement = document.querySelector(`.dropdown div[data-value="${value}"]`);
    if(optionElement){
        optionElement.classList.add("selected-option");
    }
});

updateHiddenInput();

document.querySelectorAll(".dropdown div[data-value]").forEach(option => {
    const value = option.getAttribute("data-value");

    option.addEventListener("click", function(){
        let text = this.innerText;
        addOrRemoveTag(value, text, this);
    });
});

function toggleDropdown(){
    const dropdown = document.querySelector(".dropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function addOrRemoveTag(value, text, optionElement){
    const index = selectedLanguages.indexOf(value);

    if(index === -1){
        selectedLanguages.push(value);
        updateHiddenInput();

        const tag = document.createElement("div");
        tag.classList.add("tag");
        tag.setAttribute("data-value", value);
        tag.innerHTML = `${text} <span onclick="removeTag(this)">×</span>`;
        document.querySelector(".selected-tags").appendChild(tag);
        optionElement.classList.add("selected-option");
    }else{
        removeTagByValue(value);
    }
}

function removeTag(span){
    const tag = span.parentElement;
    const value = tag.getAttribute("data-value");
    removeTagByValue(value);
}

function removeTagByValue(value){
    selectedLanguages = selectedLanguages.filter(lang => lang !== value);
    updateHiddenInput();

    const tagElement = document.querySelector(`.tag[data-value="${value}"]`);
    if(tagElement) tagElement.remove();

    const optionElement = document.querySelector(`.dropdown div[data-value="${value}"]`);
    if(optionElement) optionElement.classList.remove("selected-option");
}

function updateHiddenInput(){
    const container = document.querySelector(".selected-tags");
    container.querySelectorAll('input[type="hidden"]').forEach(e => e.remove());

    selectedLanguages.forEach(value => {
        if(value && value != ''){
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "skills[]";
            hiddenInput.value = value;
            container.appendChild(hiddenInput);
        }
    });
}

    document.addEventListener("click", function(event){
        if(!event.target.closest(".select-container")){
            document.querySelector(".dropdown").style.display = "none";
        }
    });
