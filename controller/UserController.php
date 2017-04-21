<?php
/**
 * @author briesl,bpellm
 */
require_once '../repository/UserRepository.php';

class UserController
{
    public function index()
    {
        $this->doLogin();

        $view = new View('user_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function create()
    {
        if(Security::isAuthenticated())
        {
          header("Location: /blog");
          exit();
        }
        $this->doCreate();

        $view = new View('user_create');
        $view->title = 'Create User';
        $view->heading = 'Create User';
        $view->display();
    }

    /**
     * Creates user and validates inputs from User. XXS prevention through escaping special characters.
     */
    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $emailregex = '/^[\w\d-._]{1,100}@[\w\d]{1,50}\.[a-z]{1,10}$/';
            $passwordregex = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
            $query = "SELECT email from USER";
            $error = false;
            $email = htmlspecialchars($_POST['email']);

            $userRepository = new UserRepository();

            if (!preg_match($emailregex, $email)) {
                $error = true;
                Error::add("user_create_email", "Please enter a valid E-Mail");
            }

            $password = $_POST['password'];
            if (!preg_match($passwordregex, $password)) {
                Error::add("user_create_password", "<h4>Password must contain:</h4><br> atleast 8 characters <br> one uppercase letter <br> one lowercase letter <br> one Number <br>");
                $error = true;
            }

            if (!empty($userRepository->readByEmail($email))){
                Error::add("user_exists","Email is already taken, please try again.");
                $error = true;
            }

            if (!$error) {
                $firstName = htmlspecialchars($_POST['firstName']);
                $lastName = htmlspecialchars($_POST['lastName']);

                $userRepository->create($firstName, $lastName, $email, $password);
                Success::add("create_success", "Registration Successful!");
                header('Location: /user');
            }
        }
    }

    /**
     * Logs in the user and hashes the password.
     */
    public function doLogin()
    {

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_hash = hash('sha256', $password);

            $userRepository = new UserRepository();
            $user = $userRepository->readByEmail($username);

            if ($user != NULL && $user->password == $password_hash) {
                $_SESSION[Security::SESSION_USER] = $user;
                header("Location: /blog");
            } else {
                Error::add("user_login", "Username or Password incorrect, please try again.");
            }
        }
    }

    /**
     * destroys session and logs out user
     */
    public function logout()
    {
        Session_destroy();
        header('Location: /');
    }

}
