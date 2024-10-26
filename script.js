//     // const sectionText = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos provident eligendi eveniet deserunt mollitia molestias repellendus voluptates, dicta nemo, quibusdam unde atque perferendis quas corrupti rem impedit eius? Harum corrupti, iure, exercitationem illum ex labore maxime optio quibusdam eaque quis enim molestiae, expedita voluptate architecto iste non dicta porro nulla? Magni porro modi fugit quia, consectetur cupiditate maxime esse ipsum fuga. Aut vitae harum ea minus excepturi?";
//     // const typewriter = new Typewriter('#typewriter',
//     //  {
//     //     loop: false,
//     //     delay: 40
//     // });

//     // typewriter.typeString(sectionText).start();



// //selecting all required elements
// const dropArea = document.querySelector(".drag-area"),
// dragText = dropArea.querySelector("header"),
// button = dropArea.querySelector("button"),
// input = dropArea.querySelector("input");
// let file; //this is a global variable and we'll use it inside multiple functions

// button.onclick = ()=>{
//   input.click(); //if user click on the button then the input also clicked
// }

// input.addEventListener("change", function(){
//   //getting user select file and [0] this means if user select multiple files then we'll select only the first one
//   file = this.files[0];
//   dropArea.classList.add("active");
//   showFile(); //calling function
// });


// //If user Drag File Over DropArea
// dropArea.addEventListener("dragover", (event)=>{
//   event.preventDefault(); //preventing from default behaviour
//   dropArea.classList.add("active");
//   dragText.textContent = "Release to Upload File";
// });

// //If user leave dragged File from DropArea
// dropArea.addEventListener("dragleave", ()=>{
//   dropArea.classList.remove("active");
//   dragText.textContent = "Drag & Drop to Upload File";
// });

// //If user drop File on DropArea
// dropArea.addEventListener("drop", (event)=>{
//   event.preventDefault(); //preventing from default behaviour
//   //getting user select file and [0] this means if user select multiple files then we'll select only the first one
//   file = event.dataTransfer.files[0];
//   showFile(); //calling function
// });

// function showFile(){
//   let fileType = file.type; //getting selected file type
//   let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
//   if(validExtensions.includes(fileType)){ //if user selected file is an image file
//     let fileReader = new FileReader(); //creating new FileReader object
//     fileReader.onload = ()=>{
//       let fileURL = fileReader.result; //passing user file source in fileURL variable
//       let imgTag = <img src="${fileURL}" alt="">; //creating an img tag and passing user selected file source inside src attribute
//       dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
//     }
//     fileReader.readAsDataURL(file);
//   }else{
//     alert("This is not an Image File!");
//     dropArea.classList.remove("active");
//     dragText.textContent = "Drag & Drop to Upload File";
//   }
// }
// function handleFileSelect(event) {
//   const fileList = event.target.files || event.dataTransfer.files;
//   if (fileList.length > 0) {
//       const file = fileList[0];
//       const fileSize = file.size; // in bytes
//       const fileSizeInMB = fileSize / (1024 * 1024); // convert to MB
//       const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

//       // Check file size
//       if (fileSizeInMB > 1) {
//           alert("File size should not exceed 1MB");
//           document.getElementById('image').value = ''; // Clear file input
//           return false;
//       }

//       // Check file type
//       if (!allowedTypes.includes(file.type)) {
//           alert("File type not supported. Please upload an image.");
//           document.getElementById('image').value = ''; // Clear file input
//           return false;
//       }

//       // File meets criteria, proceed with upload
//       console.log('File selected:', file);
//       return true;
//   }
// }

// let handleFormSubmit = (event) => {
//   if (!handleFileSelect(e)) {
//       e.preventDefault(); // Prevent form submission if file criteria are not met
//   }
// }