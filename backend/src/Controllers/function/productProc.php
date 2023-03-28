<?php 
//get all product 
function getAllproduct($db) {

    
    $sql = 'Select * FROM product '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get product by id 
function getproduct($db, $productId) {

    $sql = 'Select o.food_name, o.food_price, o.food_img,  FROM product o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $productId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new product 
function createproduct($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into product ( food_name, food_price, food_img)'; 
    $sql .= 'values (:food_name, :food_price, :food_img)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':food_name', ($form_data['food_name']));  
    $stmt->bindParam(':food_price', ($form_data['food_price']));
    $stmt->bindParam(':food_img', ($form_data['food_img']));
    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete product by id 
function deleteproduct($db,$productId) { 

    $sql = ' Delete from product where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$productId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update product by id 
function updateproduct($db,$form_dat,$productId) { 

    
    $sql = 'UPDATE product SET food_name = :food_name, food_price = :food_price , food_img = :food_img '; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$productId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':food_name', ($form_dat['food_name']));    
    $stmt->bindParam(':food_price', ($form_dat['food_price']));
    $stmt->bindParam(':food_img', ($form_dat['food_img']));
    $stmt->execute(); 
}