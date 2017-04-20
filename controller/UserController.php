<?php


require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $view = new View('user_index');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function create()
    {
        $this->doCreate();

        $view = new View('user_create');
        $view->title = 'Create User';
        $view->heading = 'Create User';
        $view->display();
    }

    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $emailregex = '/^[\w\d-._]{1,100}@[\w\d]{1,50}\.[a-z]{1,10}$/';
            $passwordregex = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';

            $error = false;

            $email = htmlspecialchars($_POST['email']);
            if (!preg_match($emailregex, $email)) {
                $error = true;
                Error::add("user_create_email", "Please enter a valid E-Mail");
            }

            $password = $_POST['password'];
            if (!preg_match($passwordregex, $password)) {
                Error::add("user_create_password", "<h4>Password must contain:</h4><br> atleast 8 characters <br> one uppercase letter <br> one lowercase letter <br> one Number <br>");
                $error = true;
            }


            if (!$error) {
                $firstName = htmlspecialchars($_POST['firstName']);
                $lastName = htmlspecialchars($_POST['lastName']);
                $userRepository = new UserRepository();
                $userRepository->create($firstName, $lastName, $email, $password);
                header('Location: /user');
            }
        }
    }

    public function doLogin()
    {

        if ($_POST['login']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $password_hash = hash('sha256', $password);

            $userRepository = new UserRepository();
            $user = $userRepository->readByEmail($username);



            if (isset($user) && isset($user->id)) {

                if ($user->password == $password_hash) {

                    $_SESSION[Security::SESSION_USER] = $user;

                    // LOGIN OK
                    header("Location: /blog");

                } else {
                    // LOGIN NOT OK
                    echo 'User does not exist or the password is wrong';
                }

            } else {
                // LOGIN NOT OK
                echo 'User does not exist or the password is wrong';
            }
        }
    }

    public function logout()
    {
        Session_destroy();
        header('Location: /');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);


        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /');
    }
}
