const canvas = document.querySelector("canvas");
const form = document.querySelector(".signature-pad-form");
const clearButton = document.querySelector(".clear-button");
const ctx = canvas.getContext("2d");
let writingMode = false;

const modal = document.getElementById("modal");
const closeModal = document.querySelector(".close");
const modalInfo = document.getElementById("modal-info");
const signatureImage = document.getElementById("signature-image");

form.addEventListener("submit", (event) => {
    event.preventDefault();

    const imie = document.getElementById("imie").value;
    const nazwisko = document.getElementById("nazwisko").value;
    const pesel = document.getElementById("pesel").value;
    const numer_tel = document.getElementById("numer_tel").value;
    const specialista = document.getElementById("specialista").value;
    const godzina = document.getElementById("godzina").value;
    const data = document.getElementById("data").value;

    const imageURL = canvas.toDataURL();
    signatureImage.src = imageURL;
    signatureImage.height = canvas.height;
    signatureImage.width = canvas.width;
    
    modalInfo.innerHTML = `
        <p><b>Imi:</b> ${imie}</p>
        <p><b>Nazwisko:</b> ${nazwisko}</p>
        <p><b>Pesel:</b> ${pesel}</p>
        <p><b>Numer telefonu:</b> ${numer_tel}</p>
        <p><b>Specialista:</b> ${specialista}</p>
        <p><b>Godzina wizyty:</b> ${godzina}</p>
        <p><b>Data wizyty:</b> ${data}</p>
    `;

    modal.style.display = "block";

    clearPad();
});

closeModal.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

const clearPad = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
};

clearButton.addEventListener("click", (event) => {
    event.preventDefault();
    clearPad();
});

const getTargetPosition = (event) => {
    let positionX = event.clientX - event.target.getBoundingClientRect().x;
    let positionY = event.clientY - event.target.getBoundingClientRect().y;

    return [positionX, positionY];
};

const handlePointerMove = (event) => {
    if (!writingMode) return;

    const [positionX, positionY] = getTargetPosition(event);
    ctx.lineTo(positionX, positionY);
    ctx.stroke();
};

const handlePointerUp = () => {
    writingMode = false;
};

const handlePointerDown = (event) => {
    writingMode = true;
    ctx.beginPath();
    const [positionX, positionY] = getTargetPosition(event);
    ctx.moveTo(positionX, positionY);
};
ctx.lineWidth = 3;
ctx.lineJoin = ctx.lineCap = "round";

canvas.addEventListener("mousedown", handlePointerDown);
canvas.addEventListener("mouseup", handlePointerUp);
canvas.addEventListener("mousemove", handlePointerMove);

canvas.addEventListener("touchstart", handlePointerDown);
canvas.addEventListener("touchmove", handlePointerMove);
canvas.addEventListener("touchend", handlePointerUp);