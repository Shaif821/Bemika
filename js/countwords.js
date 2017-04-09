// window.addEventListener('load', function(){
    function count() {
        var total=document.getElementById("counttext").value;
        total = total.replace(/\s/g, '');
        document.getElementById("total").innerHTML="Words:"+total.length;

    }

// })