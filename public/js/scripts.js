window.onload = () => {
    let buttons = document.querySelectorAll(".form-check-input");

    for (let button of buttons) {

        button.addEventListener("click", active);
    }
}

function active() {

    let xmlhttp = new XMLHttpRequest;

    xmlhttp.open('GET', 'activeAnnonce/' + this.dataset.id);

    xmlhttp.send();
}