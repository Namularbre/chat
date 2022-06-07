<?php

interface Connectable
{
    public function connecter() : BDD;

    public function deconnecter();
}