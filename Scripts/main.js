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

async function getData(){
    const url = "./api.php";
    const raw = await fetch(url);
    const data = await raw.json();
    return data;
}

async function makeGraph() {

    var graphData = [];

    const data = await getData();

    const graphDiv = document.querySelector("#graph")
    for (let index = 0; index < 3; index++) {
        var traceX= [];
        var traceY = [];
        var trace = {
            marker:{
                size:12
            },
            line:{
                width:3
            }
        }

        Object.keys(data).forEach(date => {
            traceX.push(date)
            traceY.push(data[date][index])
        });
        trace["x"]= traceX
        trace["y"]= traceY
        index == 0 ? traceName="General" : index == 1? traceName="Examenes" : traceName="Tareas"
        trace["name"] = traceName
        graphData.push(trace)
    }

    window.innerWidth<800 ? sl = false : sl = true;

    layout = {
        showlegend:sl,
        autosize: true,
        font:{
            family: 'Courier New, monospace',
            color:"FFFFFF"
        },
        legend:{
            x:1,
            y:0.5,
            bgcolor:"#00000099",
            font: {
                family: 'sans-serif',
                size: 12,
                color: '#fff'
                },
        },
        // width: 500,
        height: 300,
        margin: {
            l: 50,
            r: 10,
            b: 60,
            t: 30,
            pad: 20
        },
        paper_bgcolor: 'rgba(0,0,0,0)',
        plot_bgcolor: 'rgba(0,0,0,0)'
    };

    config = {
        responsive:true
    }

    Plotly.newPlot(graphDiv, graphData, layout, config)
}

function getRandomColor(){
    let randomNumber = Math.round(Math.random() * 0x7FFFFF).toString(16);
    return `#${randomNumber}`
}

setTimeout(() => {
    importJson()
}, 0);