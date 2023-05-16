
let imgInp = document.getElementById("imgInp");


fileToUpload.onchange= evt=> {
  var reader = new FileReader(); 
  reader.readAsDataURL(evt.srcElement.files[0]); 
  var me = this; 
  reader.onload = function () { 
    var fileContent = reader.result; 
  console.log(fileContent); 
  const [file] = imgInp.files;
  if (file) {
    blah.src = URL.createObjectURL(file);
    console.log(file);
    
    let str = "/mediaP/"+file;
    localStorage.setItem("img1", str);
  }
}
}


