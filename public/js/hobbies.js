document.addEventListener("DOMContentLoaded", function () {
    const hobbiesContainer = document.getElementById("hobbies-container");
    const addHobbyButton = document.getElementById("btn-add-hobby");

    addHobbyButton.addEventListener("click", function () {
        const hobbyItem = document.createElement("div");
        hobbyItem.classList.add("hobby-item");

        hobbyItem.innerHTML = `
            <input type="text" name="hobbies[]" class="form-control hobby-field">
            <button type="button" class="btn-remove-hobby">Remove</button>
        `;

        hobbiesContainer.appendChild(hobbyItem);
    });

    hobbiesContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("btn-remove-hobby")) {
            const hobbyItem = event.target.closest(".hobby-item");
            hobbiesContainer.removeChild(hobbyItem);
        }
    });
});
