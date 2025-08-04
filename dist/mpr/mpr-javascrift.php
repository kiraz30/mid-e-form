<script>

function validasiFileMsj(){
    var inputFile = document.getElementById('FileMcj');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension pdf');
        inputFile.value = '';
        return false;
    }else if(inputFile.files[0].size / 1024 / 1024 > 2){
			alert('Sorry, your file Proposed Concept is too large. Max 2MB');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('PdfFileMcj').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Pdf';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasiFile(){
    var inputFile = document.getElementById('InputFile[]');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.pdf)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension pdf');
        inputFile.value = '';
        return false;
    }else if(inputFile.files[0].size / 1024 / 1024 > 2){
			alert('Sorry, your file Proposed Concept is too large. Max 2MB');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('PdfFile').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Pdf';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

</script>

