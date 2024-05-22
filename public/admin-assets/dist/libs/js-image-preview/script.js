function previewImage() {
    //getting the uploaded file details
    var img = document.querySelector('input[name=image]').files[0];
    //getting the preview component id
    var preview = document.querySelector('#preview');

    //Creating a new instance of the FileReader class
    var reader = new FileReader();

    //when the uploaded image has been finally read, set the image to be diplayed
    reader.onloadend = function () {
        preview.src = reader.result;
    }

    //if there is a form request with the key 'image'
    if (image) {
        //read the referenced key value from the URL
        reader.readAsDataURL(img);
        //Once preview image has been clicked, open the file dioalog
        preview.onclick = function () {
            document.querySelector("#image").click();
        }
        //if there is not a form request with the key 'image'
    } else {
        //Set a blank source for the image preview
        preview.src = ''
    }
}