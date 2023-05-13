<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style.CSS">
    <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<script src="sweetalert.min.js"></script>
    <title>Update Page</title>
</head>
<body  class="bg-dark" data-bs-theme="dark">
    <div class="container-lg m-2">
        <div class="container-md w-25 border p-4 rounded position-absolute top-50 start-50 translate-middle" id="form-container">
            <form class="row g-3" method="post" action="loadUpdate.php">
                <h2><a class="crudLink" href="index.php"><i class='bx bxs-chevron-left'></i></a>Update AI Info</h2>
                <div class="col-md-12">
                    <label for="AITool" class="form-label">Subscription Type:</label>
                    <select id="AITool" class="form-select" name="AITool" onchange="Display(this.value)">
                    <option selected disabled>Choose...</option>
                    <?php
                    $xml = new DOMDocument('1.0');
                    $xml->load('AITools.xml');
                    $AIs = $xml->getElementsByTagName('AI');

                    foreach ($AIs as $AI) {
                        $title = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
                        echo '<option>' . $title . '</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="col-lg-6" id="toolData">
                    <label for="Developer" class="form-label">Developer</label>
                    <input type="text" class="form-control" id="Developer" name="Developer" style="text-transform: capitalize;">
                </div>
                <div class="col-lg-6">
                    <label for="ReleaseDate" class="form-label">Release Date:</label>
                    <input type="date" class="form-control" id="ReleaseDate" name="ReleaseDate">
                </div>
                <div class="col-lg-6">
                    <label for="Category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="Category" name="Category" style="text-transform: capitalize;">
                </div>
                
                <div class="col-lg-6">
                    <label for="SubscriptionType" class="form-label">Subscription Type:</label>
                    <select id="SubscriptionType" class="form-select" name="SubscriptionType">
                    <option selected disabled>Choose...</option>
                    <option value="Free">Free</option>
                    <option value="Paid">Paid</option>
                    <option value="Freemium">Freemium</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <textarea class="form-control" id="Description" rows="3" name="Description"></textarea>
                </div>

                <div class="mb-3">  
                <label for="Image" class="form-label">Upload Image:</label>
                <input class="form-control" type="file" id="Image" name="Image" onchange="PreviewImage()">
                </div>
                
                <div class="d-flex justify-content-center">
                    <img src="" alt="" id="uploadPreview">
                </div>
                    <button type="button" class="btn btn-primary" id="update" name="update">Update</button>
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>

<script>
    //the purpose of Display function is to display the corresponding data in the input fields
    function Display(selected) {
        http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                document.getElementById("toolData").innerHTML = this.responseText;
            }
        };
        http.open("GET", "displayData.php?name=" + selected, true);
        http.send();


        
    }

    $(document).ready(function(){
        $(document).on('click', '#update',function(){
            Swal.fire({
                title: 'Are you sure you want to Save this changes?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Update'
            })
            .then((update) => {
                if (update.isConfirmed) {
                    // get form data
                    var formData = $('form.row').serialize();

                    // make POST request
                    $.post('loadUpdate.php', formData, function(response) {
                    // handle response
                    console.log(response);
                    window.location.href = "loadUpdate.php";
                    });                 
                }
            });
        });
    });


    // get input field
    var toolNameInput = $('#AITool');;

    // disable button initially
    $('#update').attr('disabled', true);

    // add event listener to input field
    toolNameInput.on('input keyup blur change', function() {
        if ($(this).val() === '') {
            $('#update').attr('disabled', true);
            // add styles to indicate disabled state, e.g. lower opacity and remove hover effects
            //$('#delete').css({'opacity': '0.5', 'cursor': 'default', 'pointer-events': 'none', 'background-color': '#ccc', 'border-color': '#ccc'});
        } else {
            $('#update').attr('disabled', false);
            // restore button styles
            //$('#delete').css({'opacity': '1', 'cursor': 'pointer', 'pointer-events': 'auto', 'background-color': '#d33', 'border-color': '#d33'});
        }
    });



        function PreviewImage() {
        var pic = new FileReader();
        pic.readAsDataURL(document.getElementById("Image").files[0]);
        pic.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };
</script>