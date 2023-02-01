var data;

function redirect(url) {
    location.href = url;
}

function noWLogo() {
    const divs = document.getElementsByTagName("div");
    const div = divs[divs.length - 1];

    if (div.firstChild == null) return;
    if (div.firstChild.getElementsByTagName("a") && div.firstChild.title == "Hosted on free web hosting 000webhost.com. Host your own website for FREE.") div.remove();

}

function changeIndexPage(event = null) {
    const classes = event.target.className;
    const wrapper = document.querySelector(".wrapper");
    const downButton = document.querySelector(".down");
    const upButton = document.querySelector(".up");

    const nav = document.querySelector(".nav-buttons");

    currentPage = wrapper.classList[1];
    currentPage = parseInt(currentPage[currentPage.length - 1]);

    if (currentPage <= 1 && classes.includes("up")
        || currentPage >= 3 && classes.includes("down")) return;

    if (classes.includes("up")) landPage = currentPage - 1;
    else if (classes.includes("down")) landPage = currentPage + 1;

    nav.classList.add("invisible");
    wrapper.classList.remove(`active-page${currentPage}`);

    if (classes.includes("up")) {
        if (landPage == 1) upButton.classList.add("invisible");
        setTimeout(() => { downButton.classList.remove("invisible") }, 400);
        wrapper.classList.add(`active-page${landPage}`)
    } else if (classes.includes("down")) {
        if (landPage == 3) downButton.classList.add("invisible")
        setTimeout(() => { upButton.classList.remove("invisible") }, 400);
        wrapper.classList.add(`active-page${landPage}`);
    } else return console.log("Evento no valido");

    setTimeout(() => {
        nav.classList.remove("invisible");
    }, 800);
}

async function importJson() {
    const jsonPath = "./Resources/badWords.json";
    const response = await fetch(jsonPath);
    data = await response.json();
}

function validateForm(event) {

    const words = [...data["EN"]["words"], ...data["ES"]["words"]];

    let text = "";
    text = document.getElementById("comentario").value.split(' ');

    text.forEach(element => {
        if (words.includes(element.toLowerCase())) {
            event.preventDefault()
            alert("validation failed false"); //PROCEDURE TO NOT VALIDATE
            return false;
        }
    })
    return true
}

setTimeout(() => {
    importJson()
}, 0);