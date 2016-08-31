<?php

class CustomerModel extends Model
{
    public function login($username, $password, $salt = "inchoo")
    {
        $password = $password . $salt;
        $password = sha1($password);
        $query = self::getDatabase()->prepare("SELECT * FROM User WHERE Username = :username");
        $query2 = self::getDatabase()->prepare("SELECT * FROM User WHERE Username = :username AND Password = :password");
        $query->bindParam(':username', $username);
        $query->execute();
        $query2->bindParam(':username', $username);
        $query2->bindParam(':password', $password);
        $query2->execute();
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
        return $error_array;
    }

    public function register($username, $password, $email, $salt = "inchoo")
    {
        $password = $password . $salt;
        $password = sha1($password);
        $query = $this->getDatabase()->prepare("INSERT INTO User(Username,Password,Email) VALUES(:username,:password,:email)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->execute();
    }

    public function validateReg($username, $password, $email)
    {
        $error_array = array();
        $query = self::getDatabase()->prepare("SELECT * FROM User WHERE Username=:username");
        $query2 = self::getDatabase()->prepare("SELECT * FROM User WHERE Email=:email");
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

        if (strlen($password) < 5 || strlen($password > 7)) {
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
}









