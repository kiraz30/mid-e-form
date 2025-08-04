<script>
function validasiFileImage(){
    var inputFile = document.getElementById('Inputfile');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpg|.jpeg|.png|.gif');
        inputFile.value = '';
        return false;
    }else if(inputFile.files[0].size / 1024 / 1024 > 3){
			alert('Sorry, your file Proposed Concept is too large. Max 3MB');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('Inputfile').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
</script>

