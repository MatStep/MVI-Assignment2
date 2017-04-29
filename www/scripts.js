// Scripts file

console.log("hello");

$("#myForm").submit(function(e) {

    e.preventDefault();

    console.log("filled");

    $.ajax({
        type: 'POST',
        url: 'app.php',
        data: $("#myForm").serialize(),
        success: function (data) {
            console.log(data);
            $(".result").html("Dostaneš známku: " +  data);
        },
        error: function(request, static, error) {
            console.log(request);
        }
    });
});

// Override default html required check
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                if(e.target.type.toLowerCase() == 'text') {
                    e.target.setCustomValidity("Prosím vyplňte toto pole.");
                }
                else if(e.target.type.toLowerCase() == 'email') {
                    e.target.setCustomValidity("Prosím vyplňte správny formát pre emailovú adresu.");
                }
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
});

function validateForm(form) {
    form.each(function() {
        if($(this).val() === '')
            return false;
    });
    return true;
}
