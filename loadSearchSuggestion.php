<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style.css">
    <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="jquery-3.3.1.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<script src="sweetalert.min.js"></script>
    <title>Search Result</title>
</head>
<body class="bg-dark" data-bs-theme="dark">
    <div id="particles-js"></div>
    <script src="particles.js"></script>
    <script src="app.js"></script>
    <div class="result">
    <?php
        $xml = new DOMDocument("1.0");
        $xml->load('AITools.xml');
        $AIs = $xml->getElementsByTagName('AI');

        $flag = 0;

        $search = strtolower($_REQUEST["q"]); 

        foreach($AIs as $AI){
            $ToolName = $AI->getElementsByTagName('ToolName')->item(0)->nodeValue;
            $Developer = $AI->getElementsByTagName('Developer')->item(0)->nodeValue;
            $ReleaseDate = $AI->getElementsByTagName('ReleaseDate')->item(0)->nodeValue;
            $Category = $AI->getElementsByTagName('Category')->item(0)->nodeValue;
            $description = $AI ->getElementsByTagName("Description")->item(0)->nodeValue;
                $image = $AI->getElementsByTagName('Image')->item(0)->nodeValue;
            
            
            
            $Tools = strtolower($ToolName);
            $Dev = strtolower($Developer);
            $Cat = strtolower($Category);

            if(
                ($search == $Tools) ||
                ($search == $Dev) ||
                ($search == $ReleaseDate) ||
                ($search == $Cat)
            ){
                $flag++;
                $description = $AI ->getElementsByTagName("Description")->item(0)->nodeValue;
                $image = $AI->getElementsByTagName('Image')->item(0)->nodeValue;
                $SubscriptionType = $AI->getElementsByTagName('SubscriptionType')->item(0)->nodeValue;
                echo'
                <div class="card position-absolute top-50 start-50 translate-middle" style="width: 25rem;">
                <img src="data:image;base64,'.$image.'" class="card-img-top" alt="..." id="toolImage">
                <div class="card-body">
                    <h5 class="card-title">'.$ToolName.'</h5>
                    <p class="card-text" id="desc">'.$description.'</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Developer: '.$Developer.'</li>
                    <li class="list-group-item">Release Date: '.$ReleaseDate.'</li>
                    <li class="list-group-item">Category: '.$Category.'</li>
                    <li class="list-group-item">Subscription Type: '.$SubscriptionType.'</li>
                </ul>
                <div class="card-body">
                    <a href="index.php" class="btn btn-primary">Return</a>
                </div>
                </div>
                    ';
            }
        }
        if($flag == 0){
            echo'<p>No Record Found.</p>';
            
        }
    ?>
    </div>
</body>
</html>

