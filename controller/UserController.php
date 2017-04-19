<?php


require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Create User';
        $view->heading = 'Create User';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function login()
    {
        $view = new View('user_login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function doLogin()
    {
        if ($_POST['login']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $password_hash = hash('sha256', $password);

            $userRepository = new UserRepository();
            $user = $userRepository->readByEmail($username);

            var_dump($user);

            if (isset($user) && isset($user->id)) {

                if ($user->password == $password_hash) {

                    $_SESSION[Security::SESSION_USER] = $user;

                    // LOGIN OK
                    header("Location: /user");

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
        header('Location: /user/login');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);


        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
