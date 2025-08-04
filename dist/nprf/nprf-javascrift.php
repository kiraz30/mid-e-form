<script>
/*function validasiFileProposedconcept(){
    var inputFile = document.getElementById('FileProposedconcept');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileProposedconcept').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
function validasiFileRequestforcontent(){
    var inputFile = document.getElementById('FileRequestforcontent');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileRequestforcontent').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

function validasiFileRequestfordesign(){
    var inputFile = document.getElementById('FileRequestfordesign');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileRequestfordesign').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

function validasiFileItemdetail(){
    var inputFile = document.getElementById('FileItemdetail');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileItemdetail').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

function validasiFileCompetitor(){
    var inputFile = document.getElementById('FileCompetitor');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileCompetitor').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}


function validasiFileOutlineofschedule(){
    var inputFile = document.getElementById('FileOutlineofschedule');
    var pathFile = inputFile.value;
    var ekstensiOk = /(.jpg|.jpeg|.png|.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Please upload a file that has an extension .jpeg/.jpg/.png/.gif');
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
                document.getElementById('ImageFileOutlineofschedule').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}
*/
function validasiFileMaster_Schedule(){
    var inputFile = document.getElementById('FileMaster_Schedule');
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
                document.getElementById('PdfFileMaster_Schedule').innerHTML = '<img height="20"  width="20" src="'+e.target.result+'"/> New Image';
            };
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
}

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

</script>

