<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Dominik
 */
interface User {
    public function postMessage($message);
    public function login($username, $password);
    public function logout();
}
