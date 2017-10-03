<?php

class tienich {
    public static function GhiDuLieuVaoBang($dulieu,$style="")
    {
        $kq="<td".$style.">".$dulieu."</td>";
        return $kq;
    }
} 