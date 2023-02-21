async function GetCall(onReady){
    await fetch("api.php",
        {
            method: "GET",
            headers:{
                "Conent-type": "application/json"
            }
        }   
    ).then((response) => onReady(response.json()));
}