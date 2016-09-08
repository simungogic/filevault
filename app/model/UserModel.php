<?php

class UserModel extends Model
{
    public function login($username, $password, $salt = "inchoo")
    {
        $password = $password . $salt;
        $password = sha1($password);
        $query = $this->getDatabase()->prepare("SELECT * FROM User WHERE Username = :username");
        $query2 = $this->getDatabase()->prepare("SELECT * FROM User WHERE Username = :username AND Password = :password");
        $query->bindParam(':username', $username);
        $query->execute();
        $query2->bindParam(':username', $username);
        $query2->bindParam(':password', $password);
        $query2->execute();
        $rows = $query2->fetch();
        $error_array = null;

        if (empty($username) || empty($password)) {
            $error_array[] = "Neka polja su prazna!";
        }

        if ($query->rowCount() != 1) {
            $error_array[] = "Korisnik ne postoji u bazi!";
        }

        if ($query2->rowCount() != 1) {
            $error_array[] = "Lozinka nije valjana!";
        }

        if($rows['Confirmed'] == 0)
        {
            $error_array[] = "Korisnik nije potvrđen!";
        }

        return $error_array;

    }

    public function getId($username,$password,$salt = "inchoo")
    {
        $password = $password . $salt;
        $password = sha1($password);
        $query = $this->getDatabase()->prepare("SELECT UserId FROM User WHERE Username = :username AND Password = :password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        $rows = $query->fetch();
        return $rows['UserId'];
    }

    public function register($username, $password, $email, $salt = "inchoo")
    {
        $password = $password . $salt;
        $password = sha1($password);
        $validate = $this->randomString();
        $query = $this->getDatabase()->prepare("INSERT INTO User(Username,Password,Email,Validate,Confirmed) VALUES(:username,:password,:email,:validate,:confirmed)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':validate', $validate);
        $query->bindParam(':confirmed', $confirmed);
        $query->execute();
    }

    public function validateReg($username, $password, $email)
    {
        $error_array = array();
        $query = $this->getDatabase()->prepare("SELECT * FROM User WHERE Username=:username");
        $query2 = $this->getDatabase()->prepare("SELECT * FROM User WHERE Email=:email");
        $query->bindParam(':username', $username);
        $query2->bindParam(':email', $email);
        $query->execute();
        $query2->execute();

        if (empty($username) || empty($password) || empty($email)) {
            $error_array[] = "Neka polja nisu popunjena!";
        }

        if (!$this->whitespaces($username, $email, $password)) {
            $error_array[] = "Whitespace-ovi nisu dopušteni!";
        }

        if ($query->rowCount() > 0) {
            $error_array[] = "Username već postoji!";
        }

        if ($query2->rowCount() > 0) {
            $error_array[] = "E-mail je zauzet!";
        }

        if (strlen($password) < 5 || strlen($password) > 7) {
            $error_array[] = "Lozinka mora biti između 5 i 7 znakova!";
        }

        if (!$this->validateEmail($email)) {
            $error_array[] = "E-mail nije u valjanom formatu!";
        }
        return $error_array;
    }

    public function whitespaces($username, $email = null, $password)
    {
        if (preg_match('/\s/', $username) || preg_match('/\s/', $email) || preg_match('/\s/', $password)) {
            return false;
        } else return true;
    }

    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else return true;
    }

    public static function redirect($url)
    {
        header('Location:'.$url);
        die();
    }

    public function randomString($length = 32) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters)-1;
        for ($i = 0; $i < $length; $i++) {
            $rand = rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function verify($value)
    {
        $query = $this->getDatabase()->prepare("SELECT Validate FROM User WHERE Validate=:validate");
        $query2 = $this->getDatabase()->prepare("UPDATE User SET Confirmed='1' WHERE Validate=:validate");
        $query->bindParam(':validate', $value);
        $query2->bindParam(':validate', $value);
        $query->execute();
        if($query->rowCount() == 1)
        {
            $query2->execute();
        }
    }

}









