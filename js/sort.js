function sortFunction(){
    var sort_element = document.getElementById("sort").value;
    console.log(sort_element);
    var dataString = 'sort=' + sort_element ;
    console.log(dataString);

    $.ajax({
        type: "POST",
        url: "http://lab1/index.php",
        data: dataString,
        cache: false,
        success: function(html) {
            alert('111');

            //alert(html);
            //document.location.href = "http://lab1/connection_user.php";
        }
    });
}