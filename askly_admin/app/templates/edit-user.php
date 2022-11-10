<div class="text-center">
    <form method="post" class="w-25 m-auto">
        <h2>Nom</h2>
        <input type="text" name="nom" id="nom" value="<?= $u['nom'] ?>" class=" form-control"><br>
        <h2>Prénom</h2>
        <input type="text" name="prenom" id="prenom" value="<?= $u['prenom'] ?>" class=" form-control"><br>
        <h2>Email</h2>
        <input type="text" name="email" id="email" value="<?= $u['email'] ?>" class=" form-control"><br>
        <h2>Rôle</h2>
        <select name="grade" id="grade" class=" form-select">
            <option value="admin">Administrateur</option>
            <option value="assistant">Assistant</option>
            <option value="stagiaire">Stagiaire</option>
            <option value="user">Membre</option>
        </select><br>
        <input type="submit" value="Modifier" name="edit" id="edit" class="form-control">
    </form>
</div>