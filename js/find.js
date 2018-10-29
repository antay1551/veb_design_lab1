function findFunction(){
    var find_element = document.getElementById("find").value;
    console.log(find_element);
    var dataString = 'find=' + find_element;
    console.log(dataString);

    $.ajax({
        type: "POST",
        url: "http://lab1/index.php",
        data: dataString,
        cache: false,
        success: function(html) {
        }
    });
}