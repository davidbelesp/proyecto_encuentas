async function getJson(jsonFile){
    const response = await fetch(jsonFile);
    const data = await response.json();
    validation(data);
}
window.validation=function(data){

    let text = "";
    text = document.getElementById("comentario").value.split(' ');
    text.forEach(element => {
        data.words.forEach(badWord =>{
            if(element.toLowerCase()==badWord){
            alert("validation failed false");
            return;
        }
        })

    })
    document.getElementById("myForm").submit();
}