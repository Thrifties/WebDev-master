<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="jquery-3.3.1.min.js"></script>
        <script src="jquery-ui.min.js"></script>
        <script src="sweetalert.min.js"></script>
        <title>Delete</title>
    </head>

    <body>

<body  class="bg-dark" data-bs-theme="dark">
    <div id="particles-js"></div>
    <script src="particles.js"></script>
    <script src="app.js"></script>
    <div class="container-lg m-2">
        <a class="crudLink" href="index.php">Back</a>
        <div class="container-md w-25 border p-4 rounded position-absolute top-50 start-50 translate-middle" id="form-container">
            <form class="row g-3" method="post" action="loadDelete.php">
                <h2><a class="crudLink" href="index.php"><i class='bx bxs-chevron-left'></i></a>Delete AI Info</h2>
                <div class="col-md-12">
                    <label for="ToolName" class="form-label">AI Toolname:</label>
                    <select id="ToolName" class="form-select" name="ToolName" onchange="Display(this.value)">
                    <option selected disabled>Choose...</option>
                    <?php
                        $xml = new DOMDocument('1.0');
                        $xml->load('AITools.xml');
                        $AIs = $xml->getElementsByTagName('AI');
    
                        foreach($AIs as $AI){
                            $title = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
                            echo'<option>'. $title .'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div id="toolData"></div>
                    <button type="button" class="btn btn-primary" id="delete" name="delete">Delete</button>
                </div>
            </form>
        </div>
        
    </div>
    </body>

</html> 
<script>
    function Display(selected) {
        http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                document.getElementById("toolData").innerHTML = this.responseText;
            }
        };
        http.open("GET", "removeData.php?name=" + selected, true);
        http.send();


        
    }

    $(document).ready(function(){
    $(document).on('click', '#delete',function(){
        Swal.fire({
            title: 'Are you sure you want to Delete this?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Delete'
              })
              .then ((remove)=>{
                if (remove.isConfirmed){
                    // get the selected tool name
                    var toolName = $('#ToolName').val();

                    // send the tool name as a POST request to loadDelete.php
                    $.post("loadDelete.php", {ToolName: toolName})
                    .done(function(data) {
                        // handle the response from loadDelete.php if necessary
                        console.log(data);
                    })
                    .fail(function() {
                        // handle any errors that may occur during the request
                        alert('An error occurred while trying to delete the selected tool.');
                    });

                    // redirect the user to loadDelete.php
                    window.location.href = "loadDelete.php";
                }
              })

    })
    });

    // get input field
    var toolNameInput = $('form.row #ToolName');

    // disable button initially
    $('#delete').attr('disabled', true);

    // add event listener to input field
    toolNameInput.on('input keyup blur change', function() {
        if ($(this).val() === '') {
            $('#delete').attr('disabled', true);
            // add styles to indicate disabled state, e.g. lower opacity and remove hover effects
            //$('#delete').css({'opacity': '0.5', 'cursor': 'default', 'pointer-events': 'none', 'background-color': '#ccc', 'border-color': '#ccc'});
        } else {
            $('#delete').attr('disabled', false);
            // restore button styles
            //$('#delete').css({'opacity': '1', 'cursor': 'pointer', 'pointer-events': 'auto', 'background-color': '#d33', 'border-color': '#d33'});
        }
    });
    

     


</script>