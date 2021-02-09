# PHPass

Imagine getting asked to fix a bug on an old web app, already in production.

You load up the database and check out the Users table. To your horror, the passwords are stored in plaintext!

This project will automatically hash your passwords and implement the required changes on the table and the login form.

## Usage
1. Set the proper variables in config.php
2. Run main.php however you want to. I wrote it for shell, might work on an HTML UI in the future.
3. Make the changes to your login page, to use PHP's [password\_verify function](https://www.php.net/manual/en/function.password-verify.php).
4. Test that login still works.
5. Delete the \*\_backup column!! If you don't do this step, why even bother..
6. (Optional, *highly* recommended) Implement a temporary password feature for the project. So, after a manager sets their password, the system will prompt them to change it.
This should be enabled immediately, and users should probably be notified that their passwords were not stored securely. Ask them to change passwords anywhere they reused that password.
(That's probably not going to happen though.)
