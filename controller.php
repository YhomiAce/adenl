<?php
    
    function fetchAllInvoice($conn)
    {
        $sql = "SELECT * FROM plans";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function fetchUser($conn)
    {
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function saveInvoice($conn,$name,$email,$phone,$planName,$planPrice,$approveBy)
    {
        $sql = "INSERT INTO plans(name,email,phone,plan_name,plan_price,approve_by) VALUES(:name,:email,:phone,:planName,:planPrice,:approveBy)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phone,
            "planName"=>$planName,
            "planPrice"=>$planPrice,
            "approveBy"=>$approveBy
        ]);
        return true;
    }
?>