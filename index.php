<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.3.1.min.js"></script>
		<script src="jquery-ui.min.js"></script>
        <link rel="stylesheet" media="screen"href="CSS\style2.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <title>IT 310 ACTIVITY 3 XML WITH CRUD USING DOM PHP</title>
    </head>
    <body class="bg-dark" data-bs-theme="dark">
    <div id="particles-js"></div>
    <script src="particles.js"></script>
    <script src="app.js"></script>
    
    <div class="container-fluid g-0" id="container">
        <nav class="navbar sticky-top bg-dark" data-bs-theme="dark">
            <div class="container-fluid px-5">
                <div class="d-flex gap-3">
                    <a class="crudLink" href="create.php">Add</a>
                    <a class="crudLink" href="update.php">Update</a>
                    <a class="crudLink" href="delete.php">Delete</a>
                </div>
                <form class="d-flex align-items-center navbar-nav" role="search" method="post" action="loadSearch.php">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" onkeyup="showSearch(this.value)">
                </form>
            </div>
            <div id="result-box"></div>
        </nav>
        <div class="container py-3">
            
            <?php 
            $xml = new domdocument("1.0");
            $xml->load("AITools.xml");
            
            $AIs = $xml->getElementsByTagName("AI");
            
            foreach($AIs as $AI)
            {
            $toolName = $AI->getElementsByTagName("ToolName")->item(0)->nodeValue;;
            $developer = $AI->getElementsByTagName("Developer")->item(0)->nodeValue;
            $releaseDate = $AI->getElementsByTagName("ReleaseDate")->item(0)->nodeValue;
            $category = $AI->getElementsByTagName("Category")->item(0)->nodeValue;
            $subscriptionType = $AI->getElementsByTagName("SubscriptionType")->item(0)->nodeValue;
            $description = $AI ->getElementsByTagName("Description")->item(0)->nodeValue;
            $image = $AI->getElementsByTagName('Image')->item(0)->nodeValue;
            

            echo '
            
            <div class="card" style="width: 25rem;">
                <img src="data:image;base64,'.$image.'" class="card-img-top" alt="..." id="toolImage">
                <div class="card-body">
                    <h5 class="card-title">'.$toolName.'</h5>
                    <p class="card-text" id="desc">'.$description.'</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Developer: '.$developer.'</li>
                    <li class="list-group-item">Release Date: '.$releaseDate.'</li>
                    <li class="list-group-item">Category: '.$category.'</li>
                    <li class="list-group-item">Subscription Type: '.$subscriptionType.'</li>
                </ul>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Read More
                    </button>
                </div>
                </div>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">'.$toolName.'</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <img src="data:image;base64,'.$image.'" class="card-img-top" alt="..." id="toolImage">
                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Developer: '.$developer.'</li>
                                <li class="list-group-item">Release Date: '.$releaseDate.'</li>
                                <li class="list-group-item">Category: '.$category.'</li>
                                <li class="list-group-item">Subscription Type: '.$subscriptionType.'</li>
                                <li class="list-group-item">Description: '.$description.'</li>
                            </ul>
                    </div>
                    </div>
                </div>
                </div>
            ';
            }
            ?>

    
    </div>
    </body>
    <script>

            /* $("#readMore").accordion(function(){
                $(this).animate({height: "60vh", width: "auto"},100);
                
            });*/

            /* $(".card").mouseenter(function(){
                $(this).animate({height: "55vh", width: "auto"}, 100);
            });
            $(".card").mouseleave(function(){
                $(this).animate({height: "40vh", width: "auto"}, 100);
            }); */

            
            
            
            // the purpose of the showSearch function is to process the loadAI.php and show the search results in the result-box

        function showSearch(search) {
            if (search.length == 0) {
                document.getElementById("result-box").innerHTML = "";
            } 
            else {
                http = new XMLHttpRequest();
                http.onreadystatechange = function() 
                {
                    if (http.readyState == 4 && http.status == 200) {
                        document.getElementById("result-box").innerHTML = http.responseText;
                    }
                };
                http.open("GET", "loadAI.php?q=" + search, true);
                http.send();
            }
        }

        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })

        function cardDisplay(clickedCard) {
            
        // Create a new div for the card display
        let cardDisplayDiv = document.createElement("div");
        cardDisplayDiv.setAttribute("id", "cardDisplay");

        // Get the data from the clicked card
        let toolName = clickedCard.querySelector(".toolName a").textContent;
        let developer = clickedCard.querySelector(":nth-child(3)").textContent.substring(11);
        let releaseDate = clickedCard.querySelector(":nth-child(4)").textContent.substring(14);
        let category = clickedCard.querySelector(":nth-child(5)").textContent.substring(10);
        let subscriptionType = clickedCard.querySelector(":nth-child(6)").textContent.substring(18);
        let description = clickedCard.querySelector("#desc").textContent.substring(13);

        // Set the innerHTML of the card display div with the data from the clicked card
        cardDisplayDiv.innerHTML = `
            <div class="card">
            <div class="image"> 
                ${clickedCard.querySelector(".image").innerHTML}
            </div>  
            <div class="toolName">${toolName}</div>
            <div>Developer: ${developer}</div>
            <div>Release Date: ${releaseDate}</div>
            <div>Category: ${category}</div>
            <div>Subscription Type: ${subscriptionType}</div> 
            <div>Description: ${description}</div>  
            <div id="readMore"></div>  
            </div>
        `;

        // Add the card display div to the body of the page
        document.body.appendChild(cardDisplayDiv);

        
        // Add a background overlay to blur the rest of the page content

        //yung css na to is nagblur or nagdim ng background kaso di na maclick yung ibang div
        /* let overlay = document.createElement("div");
        overlay.setAttribute("id", "overlay");
        overlay.style.position = "fixed";
        overlay.style.top = "0";
        overlay.style.left = "0";
        overlay.style.width = "100%";
        overlay.style.height = "100%";
        overlay.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
        overlay.style.zIndex = "998";
        document.body.appendChild(overlay); */
        

        // Add an event listener to the card display div to remove it when clicked
        cardDisplayDiv.addEventListener("click", function() {
            cardDisplayDiv.remove();
        });
        }

                
		</scrip>
    </html>