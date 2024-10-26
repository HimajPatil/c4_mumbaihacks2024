const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; 

button.onclick = ()=>{
  input.click(); 
}

input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
  showFile(); 
});


//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); 
  file = event.dataTransfer.files[0];
  showFile(); 
});

function showFile(){
  let fileType = file.type;
  let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; 
  if(validExtensions.includes(fileType)){ 
    let fileReader = new FileReader(); 
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; 
      let imgTag = '<img src="${fileURL}" alt=""'>
      dropArea.innerHTML = imgTag; 
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("This is not an Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}
function handleFileSelect(event) {
  const fileList = event.target.files || event.dataTransfer.files;
  if (fileList.length > 0) {
      const file = fileList[0];
      const fileSize = file.size; 
      const fileSizeInMB = fileSize / (1024 * 1024); 
      const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

      if (fileSizeInMB > 1) {
          alert("File size should not exceed 1MB");
          document.getElementById('image').value = ''; 
          return false;
      }

      if (!allowedTypes.includes(file.type)) {
          alert("File type not supported. Please upload an image.");
          document.getElementById('image').value = ''; 
          return false;
      }

      console.log('File selected:', file);
      return true;
  }
}

let handleFormSubmit = (event) => {
  if (!handleFileSelect(e)) {
      e.preventDefault();
  }
}