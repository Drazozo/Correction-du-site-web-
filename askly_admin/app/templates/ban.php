<div class="text-center">
    <form method="post" class="w-25 m-auto">
        <h2>Ip a bannir :</h2>
        <input type="text" name="ip" id="ip" class="form-control" value="<?php if($params['ip'] != 0){ echo $params['ip']; }  ?>">
        <h2>Raison :</h2>
        <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea><br>
        <input type="submit" value="Bannir" name="ban" class="btn btn-danger">
    </form>
</div>