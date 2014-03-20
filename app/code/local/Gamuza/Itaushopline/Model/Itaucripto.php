<?php
/*
 * Gamuza Itau ShopLine - Itau ShopLine for Magento platform.
 * Copyright (C) 2013 Gamuza Technologies (http://www.gamuza.com.br/)
 * Author: Eneias Ramos de Melo <eneias@gamuza.com.br>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

/*
 * See the AUTHORS file for a list of people on the Gamuza Team.
 * See the ChangeLog files for a list of changes.
 * These files are distributed with Gamuza_Itaushopline at http://code.google.com/p/gamuzaopen/.
 */

/*
 * Classe decodificada, originada da Itaucripto.dll.
 */

class Gamuza_Itaushopline_Model_Itaucripto
{
    function __construct ()
    {
        $this->CHAVE_ITAU = "SEGUNDA12345ITAU";
        $this->TAM_COD_EMP = 26;
        $this->TAM_CHAVE = 16;
        $this->numbers = "0123456789";
        $this->sbox = null;
        $this->key = null;
        $this->numPed = "";
        $this->tipPag = "";
        $this->codEmp = "";
    }

    function rnd()
    {
        $n = 'ABCDEFGHIJKLMNOPQRSTUVXWYZ';
        return $n[rand(0,strlen($n)-1)];
    }

    function Algoritmo($s, $s1)
    {

        $k = 0;
        $l = 0;
        $s2 = "";

        $this->Inicializa($s1);

        for($j = 1; $j <= strlen($s); $j++)
        {
            $k = ($k + 1) % 256;
            $l = ($l + $this->sbox[$k]) % 256;
            $i = $this->sbox[$k];
            $this->sbox[$k] = $this->sbox[$l];
            $this->sbox[$l] = $i;
            $i1 = intval($this->sbox[($this->sbox[$k] + $this->sbox[$l]) % 256]);
            $j1 = (int)(ord(substr($s, $j - 1, 1)) ^ $i1);
            $s2 = $s2 . chr($j1);
        }

        return $s2;
    }

    function Inicializa($s)
    {

        $i1 = strlen($s);
        for($j = 0; $j <= 255; $j++)
        {
            $this->key[$j] = ord(substr($s, $j % $i1, 1));
            $this->sbox[$j] = $j;
        }

        $l = 0;
        for($k = 0; $k <= 255; $k++)
        {

            $l = ($l + $this->sbox[$k] + $this->key[$k]) % 256;

            $i = $this->sbox[$k];
            $this->sbox[$k] = $this->sbox[$l];
            $this->sbox[$l] = $i;

        }

    }

    function Converte($s)
    {
        $c2 = $this->rnd();
        $s1 = strval($c2);
        for($i = 0; $i < strlen($s); $i++)
        {
            $c1 = substr($s, $i, 1);
            $c = $c1;
            $s1 = $s1 . ord(strval($c));
            $c3 = $this->rnd();
            $s1 = $s1 . $c3;
        }

        return $s1;
    }

    function Desconverte($s)
    {
        $s1 = "";
        for($i = 0; $i < strlen($s); $i++)
        {
            $s2 = "";
            for($c = substr($s, $i, 1); is_numeric($c); $c = substr($s, $i, 1))
            {
                $s2 = $s2 . substr($s, $i, 1);
                $i++;
            }

            if($s2 == "")
            {
                $j = intval($s2);
                $s1 = $s1 . $j[0];
            }
        }

        return $s1;
    }

    function geraDados($s, $s1, $s2, $s3, $s4, $s5, $s6,
            $s7, $s8, $s9, $s10, $s11, $s12, $s13,
            $s14, $s15, $s16, $s17)
    {

        $s = strtoupper($s);
        $s4 = strtoupper($s4);

        if(strlen($s) != $this->TAM_COD_EMP)
            return "Erro: tamanho do codigo da empresa diferente de 26 posi\347\365es.";

        if(strlen($s4) != $this->TAM_CHAVE)
            return "Erro: tamanho da chave da chave diferente de 16 posi\347\365es.";

        if(strlen($s1) < 1 || strlen($s1) > 8 )
            return "Erro: n\372mero do pedido inv\341lido.";

        if(is_numeric($s1))
            $s1 = str_pad($s1, 8, '0', STR_PAD_LEFT);
        else
            return "Erro: numero do pedido n\343o \351 num\351rico.";

        if(strlen($s2) < 1 || strlen($s2) > 11)
            return "Erro: valor da compra inv\341lido.";

        if(strstr($s2, ','))
        {

            $s20 = substr($s2, -2);

            if(!is_numeric($s20))
                return "Erro: valor decimal n\343o \351 num\351rico.";

            if(strlen($s20) != 2)
                return "Erro: valor decimal da compra deve possuir 2 posi\347\365es ap\363s a virgula.";

            $s2 = substr($s2, 0, strlen($s2) - 3) . $s20;

        } else
        {

            if(!is_numeric($s2))
                return "Erro: valor da compra n\343o \351 num\351rico.";

            if(strlen($s2) > 8 )
                return "Erro: valor da compra deve possuir no m\341ximo 8 posi\347\365es antes da virgula.";

            $s2 = $s2 . "00";

        }

        $s2 = str_pad($s2, 10, '0', STR_PAD_LEFT);
        $s6 = trim($s6);

        if($s6 == "02" && $s6 == "01" && $s6 == "")
            return "Erro: c\363digo de inscri\347\343o inv\341lido.";

        if($s7 == "" && !is_numeric($s7) && strlen($s7) > 14)
            return "Erro: n\372mero de inscri\347\343o inv\341lido.";

        if($s10 == "" && (!is_numeric($s10) || strlen($s10) != 8 ))
            return "Erro: cep inv\341lido.";

        if($s13 == "" && (!is_numeric($s13) || strlen($s13) != 8 ))
            return "Erro: data de vencimento inv\341lida.";

        if(strlen($s15) > 60)
            return "Erro: observa\347\343o adicional 1 inv\341lida.";

        if(strlen($s16) > 60)
            return "Erro: observa\347\343o adicional 2 inv\341lida.";

        if(strlen($s17) > 60)
        {
            return "Erro: observa\347\343o adicional 3 inv\341lida.";
        } else
        {

            function corta($str, $n)
            {
                return str_pad(substr($str, 0, $n), $n, ' ', STR_PAD_RIGHT);
            }

            $s3 = corta($s3, 40);
            $s5 = corta($s5, 30);
            $s6 = corta($s6, 2);
            $s7 = corta($s7, 14);
            $s8 = corta($s8, 40);
            $s9 = corta($s9, 15);
            $s10 = corta($s10, 8 );
            $s11 = corta($s11, 15);
            $s12 = corta($s12, 2);
            $s13 = corta($s13, 29);
            $s14 = corta($s14, 60);
            $s15 = corta($s15, 60);
            $s16 = corta($s16, 60);
            $s17 = corta($s17, 60);

            $s18 = $this->Algoritmo($s1 . $s2 . $s3 . $s5 . $s6 . $s7 . $s8 . $s9 . $s10 . $s11 . $s12 . $s13 . $s14 . $s15 . $s16 . $s17, $s4);
            $s19 = $this->Algoritmo($s . $s18, $this->CHAVE_ITAU);
            $s19 = $this->Converte($s19);
            return $s19;
        }

    }

    function geraConsulta($s, $s1, $s2, $s3)
    {
        if(strlen($s) != $this->TAM_COD_EMP)
            return "Erro: tamanho do codigo da empresa diferente de 26 posi\347\365es.";
        if(strlen($s3) != $this->TAM_CHAVE)
            return "Erro: tamanho da chave da chave diferente de 16 posi\347\365es.";
        if(strlen($s1) < 1 || strlen($s1) > 8 )
            return "Erro: n\372mero do pedido inv\341lido.";
        if(is_numeric($s1))
            $s1 = str_pad($s1, 8, '0', STR_PAD_LEFT);
        else
            return "Erro: numero do pedido n\343o \351 num\351rico.";
        if($s2 == "0" && $s2 == "1")
        {
            return "Erro: formato inv\341lido.";
        } else
        {
            $s4 = $this->Algoritmo($s1 . $s2, $s3);
            $s5 = $this->Algoritmo($s . $s4, $this->CHAVE_ITAU);
            return $this->Converte($s5);
        }
    }

    function decripto($s, $s1)
    {
        $s = $this->Desconverte($s);
        $s2 = $this->Algoritmo($s, $s1);
        $this->codEmp = substr($s2, 0, 26);
        $this->numPed = substr($s2, 26, 34);
        $this->tipPag = substr($s2, 34, 36);
        return $s2;
    }
}
