<?php if (Security::isAuthenticated()) : ?>

    You are loggedin!<br>
    Hello <?= $_SESSION[Security::SESSION_USER]->firstName && $_SESSION[Security::SESSION_USER]->lastName; ?>

<?php else : ?>
            </div>
            </div>
            </div>
        </div>
<?php endif; ?>