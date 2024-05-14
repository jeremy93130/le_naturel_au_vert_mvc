<?php

namespace Form;

use Model\Entity\Avis;

class AvisHandleRequest extends BaseHandleRequest
{
    public function handleInsertForm(Avis $avis)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_avis']))
        {
            extract($_POST);
            d_die($_POST);
        }
    }
}