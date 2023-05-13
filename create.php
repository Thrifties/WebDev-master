<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style.css">
    <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.css">
     <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<script src="sweetalert.min.js"></script>
    <title>Create Page</title>
</head>
<body  class="bg-dark" data-bs-theme="dark">
    <div class="container-lg m-2">
        <div class="container-md w-25 border p-4 rounded position-absolute top-50 start-50 translate-middle" id="form-container">
            <form class="row g-3" method="post" action="loadCreate.php">
                <h2><a class="crudLink" href="index.php"><i class='bx bxs-chevron-left'></i></a>Add AI</h2>
                <div class="col-md-12">
                    <label for="AITool" class="form-label">AI Tool:</label>
                    <input type="text" class="form-control" id="AITool" name="AITool" style="text-transform: capitalize;">
                </div>
                <div class="col-lg-6">
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
                    <button type="submit" class="btn btn-primary" id="addBtn" name="submit">Add</button>
                </div>
            </form>
        </div>
        
    </div>


    <script>

        $(document).ready(function(){

            // Di nagana yung pagcheck ng existing AI Tool
            $("#AITool").blur(function(){

                var toolNameInput = document.getElementById("AITool");
                var toolNameValue = toolNameInput.value;

                var xml = new XMLHttpRequest();
                xml.open("GET", "AITools.xml", false);
                xml.send();
                var xmlDoc = xml.responseXML;
                var tools = xmlDoc.getElementsByTagName("AI");
                

                for (var i = 0; i < tools.length; i++) {
                    var toolName = tools[i].getElementsByTagName("ToolName")[0].childNodes[0].nodeValue.toLowerCase();
                    console.log(tools.length);
                    console.log(toolName);
                    if (toolName === toolNameValue) {
                        Swal.fire({
                            title: "Invalid Tool Name",
                            icon: "error",
                            text: "The AI Tool name already exists!",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $(this).val("");
                        return false;
                    }
                }           
            });     

        })

        function PreviewImage() {
        var pic = new FileReader();
        pic.readAsDataURL(document.getElementById("Image").files[0]);
        pic.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };

        // get all input fields
        var inputs = $('form.row :input');

        // disable button initially
        $('button[type="submit"]').attr('disabled', true);

        // add event listeners to input fields
        inputs.on('input keyup blur change', function() {
        var empty = false;
        inputs.each(function() {
            if ($(this).prop('required') && $(this).val() === '') {
            empty = true;
            return false;
            }
            if ($(this).prop('type') === 'file' && $(this).prop('files').length === 0) {
            empty = true;
            return false;
            }
        });
        if (empty) {
            $('button[type="submit"]').attr('disabled', true);
            //dito ilalagay yung pagdisable nung effects nung button bale need din pag empty pa yung fields is disabled din hover effects and mas babaan siguro opacity
        } else {
            $('button[type="submit"]').attr('disabled', false);
        }
        });

        document.getElementById("choosePhotoBtn").addEventListener("click", function() {
            document.getElementById("Image").click();
        });

    </script>
</body>
</html>