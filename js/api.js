
const URL= "www.themealdb.com/api/json/v1/1/search.php?s=Arrabiata";

const getFacts = async () =>{
    console.log("Getting data......");
    let response = await fetch(URL);
    console.log(response);
}