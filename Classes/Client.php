<?php


class Client extends Utilisateur
{
    public function register(){
        $conn = DbConnection::getConnection();
        $sql = "INSERT into users (nom,prenom,email,password,role) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $motpasse_hash = password_hash($this->password,PASSWORD_BCRYPT)  ;
        return $stmt->execute([$this->nom,$this->prenom,$this->email,$motpasse_hash,$this->role]);

    }
}

?>