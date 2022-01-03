<?php

function component($id, $img, $name, $description, $universe, $category, $condition){

    switch($condition){
        case 'new':
            $conditionClass = 'cardConditionNew';
            break;
        case 'good':
            $conditionClass = 'cardConditionGood';
            break;
        case 'used':
            $conditionClass = 'cardConditionUsed';
            break;
    }

    $element="
        
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
                    <div class='col text-center cardCategory'><p>$category</p></div>
                    <div class='col text-center cardCondition'><p class='$conditionClass'>$condition</p></div>
                </div> 
                <div class='row'>
                <input name='productId' value='$id' class='productId'>
    ";
    echo $element;
}