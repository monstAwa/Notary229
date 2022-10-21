function sendEmail(){
    var name = $("#name");
    var email = $("#email");
    var subject = $("#subject");
    var message = $("#message");
    var phone = $("#phone");

    if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(message)){
        $.ajax({
            url: 'form-to-email.php',
            method: 'POST',
            dataType: 'json',
            data:{
                    name: name.val(),
                    email: email.val(),
                    subject: subject.val(),
                    body: body.val(),
                    phone: phone.val()
                }, success: function(response)
                {
                    $('#myForm')[0].reset();
                }
        });
    }
}
function isNotEmpty(caller){
    if(caller.val()==""){
        caller.css('border', '3px solid red');
        return false;
    }
    else
    {
        caller.css('border', '3px solid green');
        return true;
    }
}
