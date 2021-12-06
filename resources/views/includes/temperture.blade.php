    /* temperure */
    function restrictAlphas(e) {
        e.target.value = e.target.value.replace(/[\D]/g,
   '').replace(/(\d{2})/, "$1.").replace(/(\d{2}\\d{2})/, "$1.");
   }
   function addZeroes(ev) {
       debugger;
       // Convert input string to a number and store as a variable.
       var value = Number(ev.value);
       // Split the input string into two arrays containing integers/decimals
       var res = ev.value.split(".");
       // If there is no decimal point or only one decimal place found.
       if (res.length == 1 || res[1].length < 3) {
           // Set the number to two decimal places
           value = value.toFixed(1);
       }
   
    if (ev.value != "") {
           ev.value = String(value)+' ℃';
       }
   
       // Return updated or original number.
   
   }
