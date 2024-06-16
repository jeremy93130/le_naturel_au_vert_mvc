<?php

namespace Form;

use Model\Entity\Avis;
use Service\FormSecurity;

class AvisHandleRequest extends BaseHandleRequest
{
    public function handleInsertForm(Avis $avis)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_avis']))
        {
            FormSecurity::htmlSecurity($_POST);
            extract($_POST);
            d_die($_POST);
        }
    }
}