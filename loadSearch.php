<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\style2.css">
    <title>Search Result</title>
</head>
<body>
    <div class="buttons">
        <button><a href="index.php">Back</a></button>
    </div>
    <div class="result">
    <?php
        $xml = new DOMDocument("1.0");
        $xml->load('AITools.xml');
        $AIs = $xml->getElementsByTagName('AI');

        $flag = 0;
        $search = $_POST['search'];

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
                $SubscriptionType = $AI->getElementsByTagName('SubscriptionType')->item(0)->nodeValue;
                echo'
                        <div class="card" style="width: 25rem;">
                <img src="data:image;base64,'.$image.'" class="card-img-top" alt="..." id="toolImage">
                <div class="card-body">
                    <h5 class="card-title">'.$toolName.'</h5>
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

