<?php

namespace App\Handler;

/*
 *
 * Date : 04/03/2021, 00:39
 * Author : rami
 * Class HandlerInterface.php
 */

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     * @param $data
     * @return bool
     */
    public function handle(Request $request, $data): bool;

    /**
     * @return FormView
     */
    public function createView(): FormView;
}