<br>
<span class="form-text">Como devemos contatá-lo? Fique a vontade para escolher quantos quiser.</span>
<div class="modo-contato">
    <div class="item modo-contato">
        <div class="icon wa"></div>
        <div class="content">
            Whatsapp
        </div>
    </div>
    <div class="item modo-contato">
        <div class="icon em"></div>
        <div class="content">
            E-mail
        </div>
    </div>
    <div class="item modo-contato">
        <div class="icon te"></div>
        <div class="content">
            Ligue-me
        </div>
    </div>
</div>

<div class="escolha-hora">
    <div id="dropdown-horas">
        <div class="botao-escolha" id="botao-hora">
            <span class="form-text">Melhor horário?</span>
            <span class="arrow-down"></span>
        </div>
        
        <ul class="lista-horarios" id="lista-horas">
            <?php for($c = 8; $c <= 22; $c++) : ?>
                <?php $hora = ($c < 10) ? "0".$c.":00" : $c.":00" ?>
                <li>
                    <input type="checkbox" class="chk-custom">
                    <span class="form-text"><?php echo $hora; ?></span>
                </li>
            <?php endfor ?>
        </ul>
    </div>
    
    <div class="hora-escolhida" id="hora-definida">
        <span class="form-text">09:00 horas</span>
        <span class="arrow-down check"></span>
    </div>
</div>

<div class="terms">
    <input type="checkbox" name="terms" class="chk-custom verde-claro">
    <span class="form-text terms">I agree to the <span class="verde-claro">Terms of Service & Privacy Policy<span><span class="form-text">
</div>