<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="CSS\style2.CSS"> -->
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Displaying Data</title>
</head>
<body>
<?php 
    $xml = new domdocument("1.0");
    $xml ->load("AITools.xml");
	
	$name = $_REQUEST["name"]; 

	$AIs = $xml -> getElementsByTagName("AI");

    foreach($AIs as $AI) {
        $ToolName = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
        if($name == $ToolName){

            $Developer = $AI->getElementsByTagName("Developer")->item(0)->nodeValue;
            $ReleaseDate = $AI->getElementsByTagName("ReleaseDate")->item(0)->nodeValue;
            $Category = $AI->getElementsByTagName("Category")->item(0)->nodeValue;
            $SubscriptionType = $AI->getElementsByTagName("SubscriptionType")->item(0)->nodeValue;
            $Description = $AI->getElementsByTagName("Description")->item(0)->nodeValue;
            $Image = $AI->getElementsByTagName("Image")->item(0)->nodeValue;

        //lines 20-40 will display the data of the selected AI Tool
        echo '
            <div class="col-lg-6">
                    <label for="Developer" class="form-label">Developer</label>
                    <input type="text" class="form-control" id="Developer" name="Developer" value='.$Developer.'>
                </div>
                <div class="col-lg-6">
                    <label for="ReleaseDate" class="form-label">Release Date:</label>
                    <input type="date" class="form-control" id="ReleaseDate" name="ReleaseDate" value='.$ReleaseDate.'>
                </div>
                <div class="col-lg-6">
                    <label for="Category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="Category" name="Category" value='.$Category.'>
                </div>
                
                <div class="col-lg-6">
                    <label for="SubscriptionType" class="form-label">Subscription Type:</label>
                    <select id="SubscriptionType" class="form-select" name="SubscriptionType">
                    <option selected disabled>Choose...</option>
                    <option value="Free" '. (($SubscriptionType == "Free") ? "selected" : '') .'>Free</option>
                    <option value="Paid" '. (($SubscriptionType == "Paid") ? "selected" : '') .'>Paid</option>
                    <option value="Freemium" '. (($SubscriptionType == "Freemium") ? "selected" : '') .'>Freemium</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Description" class="form-label">Description:</label>
                    <textarea class="form-control" id="Description" rows="3" name="Description" value='.$Description.'></textarea>
                </div>

                <div class="mb-3">  
                <label for="Image" class="form-label">Upload Image:</label>
                <input class="form-control" type="file" id="Image" name="Image" onchange="PreviewImage()" src="data:image;base64,'.$Image.'">
                </div>
                
                <div class="d-flex justify-content-center">
                    <img src="" alt="" id="uploadPreview">
                </div>
        ';
            break;
        }
    }
    
?>
</body>
</html>
