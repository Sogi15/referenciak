function DayName(dayT) {
    switch (dayT) {
        case 0: dayT = "Vasárnap"; break;
        case 1: dayT = "Hétfő"; break;
        case 2: dayT = "Kedd"; break;
        case 3: dayT = "Szerda"; break;
        case 4: dayT = "Csütörtök"; break;
        case 5: dayT = "Péntek"; break;
        case 6: dayT = "Szombat"; break;
    }
    return dayT;
}

function MonthName(monthT)
{
    switch (monthT)
    {
        case 0: monthT = "Január"; break;
        case 1: monthT = "Február"; break;
        case 2: monthT = "Március"; break;
        case 3: monthT = "Április"; break;
        case 4: monthT = "Május"; break;
        case 5: monthT = "Június"; break;
        case 6: monthT = "Julius"; break;
        case 7: monthT = "Augusztus"; break;
        case 8: monthT = "Szeptember"; break;
        case 9: monthT = "Október"; break;
        case 10: monthT = "November"; break;
        case 11: monthT = "December"; break;
    }
    return monthT;
} 

setInterval(function() {
    var currentTime = new Date ( );    
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );   
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
    monthName = currentTime.getMonth()
    var date = currentTime.getFullYear() + "." + MonthName(monthName) + "." + currentTime.getDate();
    var day = currentTime.getDay();
    var currentTimeString = "<span>" + date + "<br>" + DayName(day) + "</span><br>" + currentHours + ":" + currentMinutes + ":" + currentSeconds;
    var currentTimeString_m = "<span>" + date +" "+ DayName(day) + "</span> " + currentHours + ":" + currentMinutes + ":" + currentSeconds;
    document.getElementById("time").innerHTML = currentTimeString;
    document.getElementById("time_m").innerHTML = currentTimeString_m;
}, 1000);