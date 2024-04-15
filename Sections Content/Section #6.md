### Section 6:
1. How to authenticate the user
2. idea of sessions
3. `$_SESSION` Super global array
4. `session_id()`
5. `session_start()`
6. check if user is authenticated using `auth()` method in `Authenticate.php` Class
7. redirect user from `LogIn.php`/`SignUp.php` Pages to `index.php` if he is already authenticated
8. then show him an alert that he is already authenticated (using `$_SESSION` not `$_GET`)
9. Logout feature
10. `unset()` function 
11. show Logout button only when the user is authenticated else show Sign In button