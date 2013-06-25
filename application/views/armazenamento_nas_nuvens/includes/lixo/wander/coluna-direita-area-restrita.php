<div class="rightMeusCursos">
    <?php if (verifica_instrutor_logado($this->session->userdata('SessionCurso'))==true):?>
    <h1>Chat Online</h1>
        <p><img src="<?php base_url()?>assets/img/icon-chat.png" align="middle" style="margin-right:5px;">
            <a class="link-chat" href="<?php echo site_url();?>chat">Acessar</a></p>
    <hr>
    <?php endif;?>
    <?php 
        if(mensagens_laterais()&&count(mensagens_laterais())>0){
        echo "<h1>Mensagens</h1>";
        $i = 0;
        foreach (mensagens_laterais() as $msg) {
        
        $t = explode(' ', $msg->created);
        $diamesano = explode('-',$t[0]);
        $horaminutossegundos = explode(':',$t[1]);

        $diamesano = $diamesano[2]."/".$diamesano[1]."/".$diamesano[0];
        $horaminutossegundos = $horaminutossegundos[0]."h".$horaminutossegundos[1];


        ?>
        
        <p class="msgRight"><?php echo $msg->texto; ?></p>
        <p class="dataMsg"><?php echo br_date_time($msg->created); ?></p>

        <?php $i++; } }

     ?>
</div>