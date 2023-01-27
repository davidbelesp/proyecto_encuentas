
import myJson from '../Resources/badWordsEn.json';
let text=document.getElementById("ValidateText").innerHTML;
let textLowerCase = text.toLowerCase;
let validator="";
function validateForm(){

    for(let i=0; i<myJson.length; i++){
        validator =" " + (myJson[i]).toLowerCase + " ";
        if(textLowerCase.includes(validator)){
            alert("validation failed false");
            returnToPreviousPage();
            return;
        }
    }
    document.getElementById("myForm").submit();
}