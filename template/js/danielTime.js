function startTime(){
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            $("#time").html('<h1>' + h+":"+m+":"+s + '</h1>');
           // document.getElementById('hora').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){startTime()},500);
}

function checkTime(i){
            if (i<10)
            {
                i="0" + i;
            }
            return i;
}