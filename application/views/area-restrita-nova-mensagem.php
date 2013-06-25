<html>
    <body style="background-color:#231F20;">
        
        <?php if($msg==1):?>
            <span style="color: white !important;display: block;margin-top: 13px;font-family: arial, sans-serif;font-size: 15px;text-align: center;"> Mensagem Enviada com sucesso.</span>
        <?php endif;?>
        <form id="frmResposta" name="frmResposta" method="post" style="width:465px;margin:0 auto;" action="<?php echo site_url();?>area_restrita_mensagem/salva_nova_mensagem">
        <font style="color:#f7931e; font-style:italic; font-size:12px; float:left;">Nova Mensagem</font><br/>
            <select name="destinatario">
                <option value="P">Enviar para o professor</option>
            </select>
            <br/><br/>
            <input type="text" name="assunto" maxlength="30" size="35">
            <br/><br/>
            <textarea id="resposta" name="resposta"  style="width:465px; margin-bottom:25px;" rows="10" class="required" style="float:left;"></textarea>
            <input type="submit" value="Enviar" id="btn-enviar" name="btn-enviar" style="float:left;">
        </form>
    </body>
</html>