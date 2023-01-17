//selecting all required elements
const dropArea = document.querySelector(".drag-area"),
  dragText = dropArea.querySelector("header"),
  button = dropArea.querySelector("button.browse_file"),
  input = dropArea.querySelector("input"),
  nameFile = dropArea.querySelector("span"),
  icon = dropArea.querySelector(".icon i");
let file; //this is a global variable and we'll use it inside multiple functions

button.onclick = (event) => {
  event.preventDefault();
  input.click(); //if user click on the button then the input also clicked
};

//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event) => {
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  button.classList.add("d-none");
  icon.className = "fab fa-java";
  dragText.textContent = "Nhớ thả đúng tệp của .jar và .class nha ông nội ^^";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("active");
  button.classList.remove("d-none");
  icon.className = "fas fa-cloud-upload-alt";
  dragText.textContent = "Xin hãy thả tệp vào đây !!!";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event) => {
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = event.dataTransfer.files[0];
  nameFile.innerHTML = file.name;
  dragText.classList.add("d-none");
  icon.className = "far fa-file";
});
