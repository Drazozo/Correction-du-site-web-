<div class="text-center">
    <table class="table table-bordered position-relative" style="z-index: 10000;">
        <tr>
            <td><p>ID</p></td>
            <td><p>User</p></td>
            <td><p>IP</p></td>
            <td><p>Date</p></td>
        </tr>
    <?php foreach($c as $v){ 
        
        $user = $db->prepare('SELECT * FROM users WHERE id = :id');
        $user->execute(['id'=>$v['account']]);
        $u = $user->fetch();

        ?>
        <tr>
            <td><p><?= $v['id'] ?></p></td>
            <td><p><?= $u['prenom']." ".$u['nom'] ?></p></td>
            <td><p><?= $v['ip'] ?><br><a href="/ban-<?= $v['ip'] ?>">Bannir</a></p></td>
            <td><p><?= $v['date'] ?></p></td>
        </tr>
        
    <?php } ?>
    </table>
</div>