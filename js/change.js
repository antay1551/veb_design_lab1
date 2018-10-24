// $('#upload').on('click', function() {
//     var file_data = $('#sortpicture').prop('files')[0];
//     var form_data = new FormData();
//     form_data.append('file', file_data);
//     alert(form_data);
//     $.ajax({
//          url: "http://lab1/change.php",        dataType: 'text',  // what to expect back from the PHP скрипт, if anything
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form_data,
//         type: 'post',
//         success: function(){
//             alert('11111'); // display response from the PHP скрипт, if any
//         }
//     });
// });


// $(document).ready(function(){
//     $("#change").submit(function() { //устанавливаем событие отправки для формы с id=form
//         var form_data = $(this).serialize(); //собераем все данные из формы
//         console.log('132');
//         $.ajax({
//             type: "POST", //Метод отправки
//             url: "send.php", //путь до php фаила отправителя
//             data: form_data,
//             success: function() {
//                 //код в этом блоке выполняется при успешной отправке сообщения
//                 alert("Ваше сообщение отпрвлено!");
//             });
//     });
// });



// function changeFunction(){
//     var login_element = document.getElementById("login").value;
//     var name_element = document.getElementById("name").value;
//     var surname_element = document.getElementById("surname").value;
//     var password_element = document.getElementById("password").value;
//     var report_password_element = document.getElementById("report_password").value;
//     var role_element = document.getElementById("role").value;
//     var filename_element = document.getElementById("filename").value;
//     var edit_element = document.getElementById("edit").value;
//
//     console.log(filename_element);
//
//     var dataString = 'login=' + login_element
//         + '&name=' + name_element
//         + '&surname=' + surname_element
//         + '&password=' + password_element
//         + '&report_password=' + report_password_element
//         + '&role=' + role_element
//         + '&filename=' + filename_element
//         + '&edit=' + edit_element
//
//
//     ;
//     // var file_data = $("#filename").prop("files")[0];
//     // var form_data = new FormData();
//     // dataString.append("file", file_data);
//     // alert(form_data);
//     // console.log(dataString);
//
//     $.ajax({
//         type: "POST",
//         url: "http://lab1/change.php",
//         data: dataString,
//         cache: false,
//         success: function(html) {
//             //alert(html);
//             alert('aaaa');
//             //document.location.href = "http://lab1/connection_user.php";
//         }
//     });
// }