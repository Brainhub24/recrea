// script for ask.php

// script for subject searchbar

const searchWrapper = document.querySelector(".subject-input");
const inputBox = searchWrapper.querySelector("[name=\"subject\"]");
const suggBox = searchWrapper.querySelector(".autocom-box");
let suggestionsNode = searchWrapper.querySelectorAll(".subject-li"); // returns a node list
let suggestions = Array.from(suggestionsNode).map((item) => item.innerText); // becomes a list of all subjects


inputBox.onkeyup = (e) => {
    let userData = e.target.value; // user entry
    let emptyArray = [];
    if (userData) {
        emptyArray = suggestions.filter((data) => {
            // filters the array to match the user entry
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });

        emptyArray = emptyArray.map((data) => {
            return data = "<li class=\"subject-li\">" + data + "</li>";
        });

        searchWrapper.classList.add("active"); // show auto-complete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            allList[i].setAttribute("onclick", "select(this)");    
        }

    } else {
        searchWrapper.classList.remove("active"); // hide auto-complete box
    }
}

// writing the categorie in the search fiel when user clicks the element
function select(element) {
    let selectUserData = element.textContent;
    if (selectUserData != "Category not found") {
        inputBox.value = selectUserData;
        searchWrapper.classList.remove("active"); // hide auto-complete box
    }
}

// adds the li together
function showSuggestions(list) {
    let listData;
    if (!list.length) {
        listData = "<li class=\"subject-li\">Category not found</li>";
    } else {
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}


// end script for subject searchbar 