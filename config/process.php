<?php

session_start();

include_once("connection.php");
include_once("url.php");

$data = $_POST;

//MODIFICAÇÃO NO BANCO
if(!empty($data)){
    
    //CRIAR CONTATO
    if($data["type"] === 'create'){ //SIGO SEM ENTEDER "TYPE"
        
        $name = $data["name"];
        $phone = $data["phone"];
        $observations = $data["observations"];

        $query = "INSERT INTO contacts (name,phone,observations) VALUES (:name, :phone, :observations)";
        
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":phone",$phone);
        $stmt->bindParam(":observations",$observations);

        try{
            
            $stmt->execute();
            $_SESSION["msg"] = "Contato criado com sucesso!";
        
        }catch(PDOException $e){
            //erro na conexão
            $error = $e->getMessage();
            echo "ERRO: $error";
        }
    }else if ($data["type"] === 'edit'){//Editor de contatos
        
        $name = $data["name"];
        $phone = $data["phone"];
        $observations = $data["observations"];
        $id = $data["id"];
        
        $query = "UPDATE contacts 
                  SET name = :name, phone = :phone, observations = :observations WHERE id = :id";

        $stmt= $conn->prepare($query);
        
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":observations",$observations);
        $stmt->bindParam(":id",$id);

        try{

            $stmt->execute();
            $_SESSION["msg"] = "Contato atualizado com sucesso!";
        
        } catch(PDOException $e){
            //erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    
    }else if ($data['type'] === 'delete'){//remove contatos
        
        $id = $data["id"];

        $query = "DELETE FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);
        
        $stmt->bindParam(":id",$id);

        try{

            $stmt->execute();
            $_SESSION["msg"] = "Contato removido com sucesso!";
       
        }catch(PDOException $e){
            $error= $e->getMessage();
            echo "Erro: $error";

        }

    }
   
    //REDIRECT HOME
    header("location:".$BASE_URL."../index.php");

}else{
    $id;
    
    if(!empty($_GET)) {
    
        $id = $_GET["id"];
}

//RETORNA O DADO DE UM CONTATO

if(!empty($id)){

$query = "SELECT * FROM contacts WHERE id=:id";

$stmt = $conn->prepare($query);

$stmt->bindParam(":id",$id);

$stmt->execute();

$contact = $stmt->fetch();
 }else{
//RETORNA O DADO DE TODOS OS CONTATOS 

$contacts = [];

$query = "SELECT * FROM contacts";

$stmt = $conn->prepare($query);

$stmt->execute();

$contacts = $stmt->fetchAll();
 }
}

//FECHAR CONEXÃO

$conn = null;