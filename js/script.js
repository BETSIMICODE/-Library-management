const barCanvas=document.getElementById("barCanvas");
const barChart=new CharacterData(barCanvas,{
    type:"bar",
    data:{
        labels:["Hoavy Ny Maraina", "Père riche père pauvre","Lovako","Larousse"],
        datasets:[
            {data:[240,120,130,100]}
        ]
    }
})