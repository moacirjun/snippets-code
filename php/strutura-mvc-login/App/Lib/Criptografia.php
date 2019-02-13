<?php

namespace App\Lib;

/**
 *
 * @author MoacirjuN
 */
class Criptografia {
    
    public function criptografar_senha($senha) {
        return md5(sha1($senha));
    }
}
