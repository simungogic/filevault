<?php

class CustomerModel extends Model
{
    public function login($username,$password)
    {
        $this->validateCustomerLoginInput($username,$password);
        if(!($this->validateCustomerLoginInput($username,$password)))
        {
            die("Netočna lozinka!");
        }
        else
        {
            session_start();
            $_SESSION['username'] = $username;
        }
    }

    public function validateCustomerLoginInput($username,$password,$salt="inchoo")
    {

        if (!empty($username) && !empty($password))
        {
                $query = self::getDatabase()->prepare("SELECT * FROM User WHERE Username=:username");
                $query->bindParam(':username',$username);
                $query->execute();
                if($query->rowCount() == 1)
                {
                    $password = $password.$salt;
                    $password = sha1($password);
                    $query = self::getDatabase()->prepare("SELECT * FROM User WHERE Username = :username AND Password = :password");
                    $query->bindParam(':username',$username);
                    $query->bindParam(':password',$password);
                    $query->execute();
                    if($query->rowCount() == 1)
                    {
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    die("Korisnik ne postoji!");
                }
            }
        else{
            die("Popunite sva polja!");
        }
    }


    public function register($username, $password, $email,$salt="inchoo")
    {
        $query = self::getDatabase()->prepare("SELECT * FROM User WHERE Username=:username");
        $query->bindParam(':username',$username);
        $query->execute();
        if (!empty($username) && !empty($password) && !empty($email)) {
            if ($this->whitespaces($username, $email, $password)) {
                if ($query->rowCount() == 0) {

                if (strlen($password) > 4 && strlen($password < 8)) {
                    if ($this->validateEmail($email)) {
                        $password = $password . $salt;
                        $password = sha1($password);
                        $query = $this->getDatabase()->prepare("INSERT INTO User(Username,Password,Email) VALUES(:username,:password,:email)");
                        $query->bindParam(':username',$username);
                        $query->bindParam(':password',$password);
                        $query->bindParam(':email',$email);
                        $query->execute();
                    } else {
                        die("Email nije u valjanom formatu!");
                    }

                } else {
                    die("Lozinka mora biti između 5 i 7 znakova!");
                }
            }
            else
            {
                die("Username već postoji!");
            }

            } else {
                die("Whitespace-ovi nisu dopušteni!");
            }


        } else {
           die('Sva polja moraju biti popunjena!');
        }

    }

    public function whitespaces($username, $email=  null, $password)
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









