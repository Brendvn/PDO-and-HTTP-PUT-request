<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDO Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
    <body>
    <div class="container">
    <!--<form action="ControllerUser.php" method="post">-->
        <form class="needs-validation" novalidate>
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" id="name" required>
                <div class="invalid-feedback">
                    Please provide a valid name.
                </div>
            </div>
            <div class="form-group">
                <label for="sname">Surname:</label>
                <input type="text" class="form-control" id="sname">
                <div class="invalid-feedback">
                    Please provide a valid surname.
                </div>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd">
                <div class="invalid-feedback">
                    Please provide a valid password.
                </div>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="container">
            <h2>Striped Rows</h2>
            <p>The .table-striped class adds zebra-stripes to a table:</p>
            <table id="tableId" class="table table-striped">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
    </body>
<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }else{
                        sendFormInfo();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    function createTableData(){
        $.post("ControllerUser.php" ,{'Method': 'Create'}, function( data ) {
            $( "#tableBody" ).html( data );
        });
    }
    function sendFormInfo(){
        var name = $('#name').val();
        var surname = $('#sname').val();
        var password = $('#pwd').val();
        var userData = JSON.stringify({"name":name,"surname":surname,"password":password});

        $.ajax({
            url: 'ControllerUser.php',
            type: 'PUT',
            data: userData,
            async: false,
            success: function(data) {
                createTableData();
            },
            error: function(xhr, status, error) {
                var err = JSON.parse(xhr.responseText);
                alert(err.Message);
            }
        });
    }
    $(document).ready(function () {
        createTableData();
        $("div.container table").delegate('tr', 'click', function() {
            var surname = $(this)[0].children[0].textContent;
            alert(surname);
        });
    });

</script>
</html>
