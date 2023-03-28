<?php 
//get all customer 
function getAllcustomer($db) {

    
    $sql = 'Select * FROM customer '; 
    $stmt = $db->prepare ($sql); 
    $stmt ->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
} 

//get customer by id 
function getcustomer($db, $customerId) {

    $sql = 'Select o.cust_name, o.cust_email, o.cust_phone, o.cust_addr FROM customer o  ';
    $sql .= 'Where o.id = :id';
    $stmt = $db->prepare ($sql);
    $id = (int) $customerId;
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}

//add new customer 
function createcustomer($db, $form_data) { 
    //stop at sisni
    $sql = 'Insert into customer ( cust_name, cust_email, cust_phone, cust_addr)'; 
    $sql .= 'values (:cust_name, :cust_email, :cust_phone, :cust_addr)';  
    $stmt = $db->prepare ($sql); 
    $stmt->bindParam(':cust_name', $form_data['cust_name']);  
    $stmt->bindParam(':cust_email', ($form_data['cust_email']));
    $stmt->bindParam(':cust_phone', ($form_data['cust_phone']));
    $stmt->bindParam(':cust_addr', ($form_data['cust_addr']));

    $stmt->execute(); 
    return $db->lastInsertID();
}


//delete customer by id 
function deletecustomer($db,$customerId) { 

    $sql = ' Delete from customer where id = :id';
    $stmt = $db->prepare($sql);  
    $id = (int)$customerId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
} 

//update customer by id 
function updatecustomer($db,$form_dat,$customerId) { 

    
    $sql = 'UPDATE customer SET cust_name = :cust_name, cust_email = :cust_email , cust_phone = :cust_phone , cust_addr = :cust_addr'; 
    $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$customerId;  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':cust_name', $form_dat['cust_name']);    
    $stmt->bindParam(':cust_email', ($form_dat['cust_email']));
    $stmt->bindParam(':cust_phone', ($form_dat['cust_phone']));
    $stmt->bindParam(':cust_addr', ($form_dat['cust_addr']));
 
    $stmt->execute(); 
}