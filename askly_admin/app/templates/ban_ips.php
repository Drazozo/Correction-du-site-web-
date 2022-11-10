<div class="text-center">
    <table class="table table-bordered position-relative" style="z-index: 10000;">
        <tr>
            <td>ID</td>
            <td>IP</td>
            <td>RAISON</td>
            <td>DATE</td>
        </tr>
        <?php foreach($i as $v){ ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= $v['ip'] ?></td>
            <td><?= $v['reason'] ?></td>
            <td><?= $v['date'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>