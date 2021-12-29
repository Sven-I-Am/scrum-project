<?php

function component($ProductImage,$ProductLabel,$ProductDescription,$ProductName,$ProductType,$ProductPrice){

    $element="
    <form action=\"#\">
        <div class=\"col\">
            <div class=\"card h-auto border border-2 border-dark \">
               <img src=\"$ProductImage\" class=\"card-img-top labelinfo\">
               <div class=\"label\">$ProductLabel</div>
                <div class=\"content\">
                    <p>$ProductDescription</p>
                </div>
                 <div class=\"card-body\">
                 <div class=\"row\">
                 <div class=\"col\">
                    <h5 class=\"card-title gap-2 m-auto text-danger text-center\">$ProductName</h5>
                 </div>  
                 <div class=\"col\">
                    <h5 class=\"card-title gap-2 mx-auto text-primary\">$ProductType</h5>
                 </div> 
                   </div>
                    <h5 class=\"card-title gap-2 mx-auto text-center\">$ProductPrice</h5>
                     <div class=\"d-grid gap-2 col-6 mx-auto\">
                        <button type=\"button\" class=\"btn btn-outline-primary\">Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ";
    echo $element;
}