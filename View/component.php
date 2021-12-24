<?php


function component(){

    $element="
    <form action=\"#\">
    <div class=\"col\">
    <div class=\"card h-auto border border-2 border-dark\">
       <img src=\".\assets\screenshots\poke.jpg\" class=\"card-img-top\">
        <div class=\"content\">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt illo aliquid repellat praesentium animi. Labore dignissimos consectetur sint, eligendi asperiores, reprehenderit hic omnis unde consequatur eaque dolore, dolores excepturi odit.</p>
        </div>
         <div class=\"card-body\">
            <h5 class=\"card-title gap-2 m-auto text-danger\">Pokemon toy</h5>
            <h5 class=\"card-title gap-2 mx-auto\">Price:</h5>
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
