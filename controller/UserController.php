<?php


require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
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
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function index()
    {
        $view = new View('user_index');
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
