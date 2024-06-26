<?php
namespace App\Helpers;

class CodeHelper
{
    public static function normalizeCode($code)
    {
        // Elimina espacios y guiones
        $normalized = preg_replace('/[\s-]+/', '', $code);

        // Valida que solo tenga caracteres alfanuméricos y exactamente 16 caracteres
        if (!preg_match('/^[a-zA-Z0-9]{16}$/', $normalized)) {
            return false;
        }

        // Añade guiones cada 4 caracteres para visualización
        return implode('-', str_split($normalized, 4));
    }

    public static function stripHyphens($code)
    {
        // Elimina guiones y espacios
        return preg_replace('/[\s-]+/', '', $code);
    }
    public static function protectedCode($code) {
        if (strlen($code) !== 16) {
            return 'Código inválido';
        }
        $parts = str_split($code, 4);
        $parts[1] = $parts[2] = '****';
        return implode('-', $parts);
    }
}
