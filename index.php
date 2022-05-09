<div>
    <form method="POST" action="CONTROLLERS/authentication.php">
        <h1>AUTHENTIFICATION</h1><br />

        <p><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>

        <div>
            <label for="Adminname">Nom d'utilisateur : </label>
            <input type="text" name="Donnees[adminname]" id="Adminname" required />
        </div>

        <div>
            <label for="Email">Adresse mail : </label>
            <input type="email" name="Donnees[email]" id="Email" required />
        </div>

        <div>
            <label for="Password">Mot de passe : </label>
            <input type="password" name="Donnees[password]" id="Password" required />
        </div>

        <div>
            <button type="submit" name="sign_in" id="SIGN_IN">Se connecter</button>
        </div>
    </form>
</div>
