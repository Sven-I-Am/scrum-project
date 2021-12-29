<?php

function component($img, $name, $description, $universe){

    $element="
        <form method='post' action='#' class='productCard p-2 mx-2 my-4 border border-4 border-dark'>
            <div class='cardContent'>
                <div class='row text-center'>
                    <h2 class='productName'>$name</h2>
                </div>
                <div class='row productImgContainer'>
                    <img src='$img' alt='$name' class='productImage card-img-top labelinfo'>
                    <div class='productDescription text-center'>
                        <p class='my-4 mx-5'>$description</p>
                    </div>
                </div>
                <div class='row productDetails'>
                    <div class='col text-center cardUniverse'><p>$universe</p></div>
                    <div class='col text-center cardCategory'><p>category</p></div>
                    <div class='col text-center cardCondition'><p>condition</p></div>
                    
                </div>
                
            </div>  
        </form>
    ";
    echo $element;
}