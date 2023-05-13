<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style2.CSS">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
    <title>Removing Data</title>
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
        /* echo "
            <div class='field'>
                <label>Developer:</label>
                <input name='Developer' id='Developer' type='text' value='$Developer' required>
            </div>
            <div class='field'>
                <label for='ReleaseDate'>Release Date:</label>
                <input name='ReleaseDate' id='ReleaseDate' type='text' value='$ReleaseDate' required>
            </div>
            <div class='field'>
                <label for='Category'>Category:</label>
                <input name='Category' id='Category' type='text' value='$Category' required>
            </div>
            <div class='field'>
                <label for='SubscriptionType'>Subscription Type:</label>
                <select name='SubscriptionType' id='SubscriptionType' required> 
                    <option value='Free' ". (($SubscriptionType == 'Free') ? 'selected' : '') .">Free</option>
                    <option value='Paid' ". (($SubscriptionType == 'Paid') ? 'selected' : '') .">Paid</option>
                    <option value='Freemium' ". (($SubscriptionType == 'Freemium') ? 'selected' : '') .">Freemium</option>
                </select>
            </div>
            <div class='field'>
                <label for='Description'>Description:</label>
                <input name='Description' id='Description' type='text' value='$Description' required>
            </div>
            
            <div class='field' id='imageContainer'>
            <label for='Image'>Choose Photo</label>    
                <img id='uploadPreview' class='anime-img' src='data:image;base64,".$Image."' style = 'width:250px; height:auto;>
                <input type='file' id='Image' name='Image' style='display: none;' onchange='PreviewImage()'>
                
            </div>
            
        "; */

        echo '
                <div class="card" style="width: 25rem;">
                <img src="data:image;base64,'.$Image.'" class="card-img-top" alt="..." id="toolImage">
                <div class="card-body">
                    <h5 class="card-title">'.$ToolName.'</h5>
                    <p class="card-text" id="desc">'.$Description.'</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Developer: '.$Developer.'</li>
                    <li class="list-group-item">Release Date: '.$ReleaseDate.'</li>
                    <li class="list-group-item">Category: '.$Category.'</li>
                    <li class="list-group-item">Subscription Type: '.$SubscriptionType.'</li>
                </ul>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Read More
                    </button>
                </div>
                </div>
            ';
            break;
        }
    }
    
?>
</body>
<script>
</script>
</html>